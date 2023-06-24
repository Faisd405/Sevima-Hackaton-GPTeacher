<?php

namespace App\Http\Livewire\Example;

use App\Models\Example;
use Livewire\Component;

class ExampleForm extends Component
{
    public $exampleId;

    public $exampleForm = [
        'name' => '',
        'description' => '',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->exampleId = $id;
            $this->exampleForm = Example::find($id)->toArray();
        }
    }

    public function render()
    {
        return view('livewire.example.example-form')
            ->extends('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'exampleForm.name' => 'required',
            'exampleForm.description' => 'required',
        ]);

        if ($this->exampleId) {
            Example::find($this->exampleId)->update($this->exampleForm);
        } else {
            Example::create($this->exampleForm);
        }

        session()->flash('success', 'Data berhasil disimpan.');

        return redirect()->route('example.index');
    }
}
