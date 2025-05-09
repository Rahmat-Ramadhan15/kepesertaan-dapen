<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    /**
     * Boot the trait and register the model events
     */
    public static function bootAuditable()
    {
        static::created(function ($model) {
            self::logAuditEvent('created', $model);
        });

        static::updated(function ($model) {
            if ($model->wasChanged()) {
                self::logAuditEvent('updated', $model);
            }
        });

        static::deleted(function ($model) {
            self::logAuditEvent('deleted', $model);
        });
    }

    /**
     * Log the audit event for the model
     * 
     * @param string $action The action performed (created, updated, deleted)
     * @param mixed $model The model being audited
     * @return void
     */
    protected static function logAuditEvent($action, $model)
    {
        $user = Auth::user();
        if (!$user) return;

        $oldValues = null;
        $newValues = null;
        $description = null;
        $idField = $model->getAuditIdField() ?? $model->getKeyName();
        $idValue = $model->{$idField};

        if ($action === 'created') {
            $newValues = $model->getAttributes();
            $description = "Menambahkan data " . class_basename($model) . " " . $idValue;
        } elseif ($action === 'updated') {
            $oldValues = collect($model->getOriginal())->only(array_keys($model->getDirty()));
            $newValues = $model->getDirty();
            $description = "Mengubah data " . class_basename($model) . " " . $idValue;
        } elseif ($action === 'deleted') {
            $oldValues = $model->getAttributes();
            $description = "Menghapus data " . class_basename($model) . " " . $idValue;
        }

        AuditLog::create([
            'user_id' => $user->nip,
            'action' => $action,
            'reference_type' => get_class($model),
            'reference_id' => $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'description' => $description,
        ]);
    }

    /**
     * Override this method in your model to specify which field to use in the audit description
     * By default it will use the primary key
     * 
     * @return string|null
     */
    public function getAuditIdField()
    {
        return 'nip';  // Default for Peserta, can be overridden in models
    }
}