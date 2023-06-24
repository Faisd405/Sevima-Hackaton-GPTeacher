<?php

namespace App\Traits;

use App\Jobs\BaseExport;
use App\Models\Archive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait WithExport
{
    private $isBatch = false;
    private $isOpen = false;

    public function useWithExport($title, $cacheKey, array|Model $data, $header)
    {
        $batch = Bus::batch([])
            ->name($this->getNameProperty($cacheKey))
            ->dispatch();

        // Folder Temp and Final
        $folder = 'export/' . $title . '/temp/' . now()->format('Y-m-d-H-i-s');
        $folderFinal = 'export/' . $title . '/final/' . now()->format('Y-m-d-H-i-s');

        // Create Archive Data
        $archive = Archive::create([
            'user_id' => auth()->user()->id,
            'description' => 'Export ' . $title,
            'name' => $this->getNameProperty($cacheKey),
        ]);

        foreach ($data as $key => $value) {
            $chunkIndex = $key + 1;
            $file = $folder . "/{$title}-{$chunkIndex}.csv";
            Storage::put('public/' . $file, 'Fixed');

            $batch->add(new BaseExport(
                $title,
                $header,
                $folder,
                $value,
                $chunkIndex,
                count($data),
                $folderFinal,
                $archive['id']
            ));
        }
    }

    public function getBatchExportProperty($cacheKey)
    {
        $batches = DB::table('job_batches')
            ->where('name', $this->getNameProperty($cacheKey))
            ->orderBy('id', 'desc')
            ->first();

        if ($batches === null) {
            $this->isBatch = false;
            $this->isOpen = false;

            return;
        }

        $this->isBatch = true;
        $this->isOpen = true;

        $batch = Bus::findBatch($batches->id);

        $this->getArchiveProperty($cacheKey);

        return $batch;
    }

    public function getArchiveProperty($cacheKey)
    {
        $archive = Archive::where('name', $this->getNameProperty($cacheKey))
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->first();

        return $archive;
    }

    private function getNameProperty($cacheKey)
    {
        return 'Export_' . auth()->user()->id . '_' . $cacheKey;
    }
}
