<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
   
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $query = \App\Models\AuditLog::with('user')->latest();

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        }

        $logs = $query->get();

        return view('admin.audit-log', compact('logs', 'tanggal'));
    }

}
