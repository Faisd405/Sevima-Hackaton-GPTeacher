<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class BaseImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected $filePath;

    protected $archiveId;

    protected $userId;

    protected $name;

    protected $key;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath, $archiveId, $userId, $name, $key)
    {
        $this->filePath = $filePath;
        $this->archiveId = $archiveId;
        $this->userId = $userId;
        $this->name = $name;
        $this->key = $key;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $storagePath = Storage::path($this->filePath);

        if (! file_exists($storagePath)) {
            return;
        }

        (new FastExcel)->import($storagePath, function ($line) {
            $this->importRow($line);
        });

        // Update Archive
        $archive = Archive::find($this->archiveId);
        $archive->status = 'success';
        $archive->save();
    }

    /**
     * Import Row
     */
    public function importRow($row): void
    {
        // Do something
    }
}
