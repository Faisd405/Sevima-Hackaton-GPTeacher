<?php

namespace App\Http\Livewire\Example;

use App\Jobs\BaseImport;
use App\Models\Archive;
use App\Models\Example;
use App\Traits\ParamQueryHelper;
use App\Traits\SelectedId;
use App\Traits\WithExport;
use App\Traits\WithImport;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ExampleIndex extends Component
{
    use WithPagination;
    use SelectedId;
    use ParamQueryHelper;
    use WithExport, WithImport;
    use WithFileUploads;

    public $modalOpen;

    public $titleExport = 'Example';

    public $cacheKeyExport = 'example';

    private $exampleBatch;

    private $exampleArchive;

    public $importFile;

    public $params = [
        'limit' => 10,
        'search' => '',
    ];

    public $attributeSearchData = ['name', 'description'];

    public function render()
    {
        $example = $this->getListExampleProperty();
        $this->exampleBatch = $this->getBatchExportProperty($this->cacheKeyExport);
        $this->exampleArchive = $this->getArchiveProperty($this->cacheKeyExport);

        if (session()->has('message')) {
            $this->dispatchBrowserEvent('toaster', [
                'type' => 'info',
                'message' => session('message'),
            ]);
        }

        return view(
            'livewire.example.example-index',
            [
                'examples' => $example,
                'exampleBatch' => $this->exampleBatch,
                'exampleArchive' => $this->exampleArchive,
            ]
        )
            ->extends('layouts.app');
    }

    public function getListExampleProperty()
    {
        $examples = Example::query();
        $examples = $examples->orderBy('id', 'desc');
        $examples = $this->searchHelper($examples, $this->params['search'], $this->attributeSearchData);

        return $examples->paginate($this->params['limit']);
    }

    public function delete()
    {
        Example::destroy($this->selectedId);

        $this->resetSelectedId();
    }

    public function export()
    {
        $this->dispatchBrowserEvent('toaster', [
            'type' => 'info',
            'message' => 'Exporting...',
        ]);

        $chunkSize = 500;
        $data = Example::select(['name', 'description'])
            ->get()
            ->chunk($chunkSize)
            ->toArray();

        $this->useWithExport(
            $this->titleExport,
            $this->cacheKeyExport,
            $data,
            [
                ['Example'],
                ['Name', 'Description'],
            ],
        );
    }

    public function downloadArchive()
    {
        $archive = Archive::where('user_id', auth()->user()->id)
            ->where('name', 'Export_' . $this->cacheKeyExport)
            ->orderBy('id', 'desc')->first();

        if ($archive) {
            $archive->update([
                'is_download' => true,
            ]);

            return Storage::download('public/' . $archive['path']);
        }
    }

    public function import()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls',
        ]);

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'info',
            'message' => 'Importing...',
        ]);

        $path = $this->importFile->store('import');

        $archive = Archive::create([
            'user_id' => auth()->user()->id,
            'name' => 'Import_' . $this->cacheKeyExport,
            'path' => $path,
            'status' => 'pending',
        ]);

        BaseImport::dispatch(
            $path,
            $archive->id,
            auth()->user()->id,
            'Import_' . $this->cacheKeyExport,
            $this->cacheKeyExport
        );
    }
}
