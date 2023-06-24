<?php

namespace App\Http\Livewire\Curriculum;

use App\Models\Curriculum;
use App\Traits\ParamQueryHelper;
use Livewire\Component;
use Livewire\WithPagination;

class CurriculumIndex extends Component
{
    use WithPagination, ParamQueryHelper;

    public $params = [
        'limit' => 10,
        'search' => '',
    ];

    public function render()
    {
        $data['curriculums'] = $this->curriculums;

        return view('livewire.curriculum.curriculum-index', $data);
    }

    public function getCurriculumsProperty()
    {
        $data = Curriculum::orderBy('created_at', 'DESC');

        $data = $this->searchHelper($data, $this->params['search'], ['name']);

        return $data->paginate($this->params['limit'] ?? 10);
    }
}
