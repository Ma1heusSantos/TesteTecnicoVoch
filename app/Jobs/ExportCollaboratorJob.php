<?php

namespace App\Jobs;

use App\Exports\CollaboratorExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExportCollaboratorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $exportId;

    public function __construct($exportId)
    {
        $this->exportId = $exportId;
    }

    public function handle()
    {
        $export = \App\Models\Export::find($this->exportId);

        if (!$export) {
            return;
        }

        $fileName = 'collaborators_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
        $path = 'exports/' . $fileName;

        Excel::store(new CollaboratorExport, $path, 'public');
        Log::info('chegou no job');

        $export->update([
            'file_path' => $path,
            'status' => 'completed'
        ]);
    }
}
