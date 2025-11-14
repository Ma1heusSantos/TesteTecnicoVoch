<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AuditController extends Controller
{
    public function index()
    {
        // A tabela padrão do pacote OwenIt\Auditing é "audits"
        $audits = DB::table('audits')->latest()->paginate(20);

        return view('Audits.audit', compact('audits'));
    }
}
