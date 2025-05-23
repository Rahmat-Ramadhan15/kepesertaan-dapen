<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    protected static function bootAuditable()
    {
        static::updated(function ($model) {
            $model->auditLog('UPDATE');
        });
        
        static::created(function ($model) {
            $model->auditLog('CREATE');
        });
        
        static::deleted(function ($model) {
            $model->auditLog('DELETE');
        });
    }
    
    public function auditLog($action)
    {
        $oldValues = [];
        $newValues = [];
        
        if ($action === 'UPDATE') {
            $changes = $this->getChanges();
            $original = $this->getOriginal();
            
            foreach ($changes as $key => $newValue) {
                if (isset($original[$key])) {
                    $oldValues[$key] = $original[$key];
                    $newValues[$key] = $newValue;
                }
            }
        } elseif ($action === 'CREATE') {
            $newValues = $this->toArray();
        } elseif ($action === 'DELETE') {
            $oldValues = $this->toArray();
        }
        
        AuditLog::create([
            'user_id' => Auth::check() ? Auth::user()->nip : 'unknown',
            'action' => $action,
            'reference_type' => get_class($this),
            'reference_id' => $this->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'description' => class_basename($this) . ' ' . strtolower($action),
        ]);
    }
}