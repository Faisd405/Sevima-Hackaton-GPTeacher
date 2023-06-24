<?php

namespace App\Jobs;

use App\Models\Archive;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Rap2hpoutre\FastExcel\FastExcel;

class BaseExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $title;

    public $heading;

    public $folder;

    public $datas;

    public $key;

    public $total;

    public $folderFinal;

    public $archiveId;

    /**
     * Create a new job instance.
     */
    public function __construct(
        $title,
        $heading,
        $folder,
        $datas,
        $key,
        $total,
        $folderFinal,
        $archiveId,
    ) {
        $this->title = $title;
        $this->heading = $heading;
        $this->folder = $folder;
        $this->datas = $datas;
        $this->key = $key;
        $this->total = $total;
        $this->folderFinal = $folderFinal;
        $this->archiveId = $archiveId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mapping = [];

        // Heading Row
        if ($this->key === 1 && $this->heading) {
            $mapping = $this->headingRow($this->heading);
        }

        // Data
        foreach ($this->datas as $data) {
            $mapping[] = $data;
        }

        // Export
        (new FastExcel($mapping))->export(storage_path("app/public/{$this->folder}/{$this->title}-{$this->key}.csv"));

        // Merge
        if ($this->key == $this->total) {
            // Name file
            $uniqueNameFinal = now()->format('Y-m-d-H-i-s');
            $titleUniqueNameFinal = "{$this->title}-{$uniqueNameFinal}";
            $titleFinal = "{$this->title}-final";

            $files = Storage::files('public/'.$this->folder);
            $mergeFilePath = storage_path("app/public/{$this->folder}/{$titleFinal}.csv");

            $fileFinal = $this->folderFinal."/{$titleUniqueNameFinal}.xlsx";
            Storage::put('public/'.$fileFinal, 'Fixed Final');
            $spreadsheetPath = storage_path("app/public/{$this->folderFinal}/{$titleUniqueNameFinal}.xlsx");

            // Merge CSV
            $fileHandle = fopen($mergeFilePath, 'w');
            foreach ($files as $key => $file) {
                if (basename($file) != "{$titleFinal}.csv") {
                    $csvFileHandle = fopen(storage_path('app/'.$file), 'r');
                    if (! feof($csvFileHandle)) {
                        fgets($csvFileHandle);
                    }
                    while (($row = fgetcsv($csvFileHandle)) !== false) {
                        fputcsv($fileHandle, $row);
                    }
                    fclose($csvFileHandle);
                }
            }
            fclose($fileHandle);

            // Load CSV data
            $reader = IOFactory::createReader('Csv');
            $spreadsheet = $reader->load($mergeFilePath);

            // Save data to XLSX
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($spreadsheetPath);

            // Delete folder
            Storage::deleteDirectory('public/'.$this->folder);
            $archive = Archive::find($this->archiveId);
            $archive->update([
                'file_name' => "{$titleUniqueNameFinal}.xlsx",
                'path' => $fileFinal,
                'is_download' => true,
            ]);
        }
    }

    public function headingRow($heading): array
    {
        if (! is_array($heading)) {
            return [$heading];
        }

        return $heading;
    }
}
