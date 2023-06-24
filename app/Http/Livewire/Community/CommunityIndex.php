<?php

namespace App\Http\Livewire\Community;

use App\Models\Curriculum;
use App\Models\Question;
use App\Traits\ParamQueryHelper;
use Livewire\Component;
use Livewire\WithPagination;

class CommunityIndex extends Component
{
    use WithPagination, ParamQueryHelper;

    public $paramsCurriculum = [
        'limit' => 10,
        'search' => '',
    ];

    public $paramsQuestion = [
        'limit' => 10,
        'search' => '',
    ];

    public function render()
    {
        $data['curriculums'] = $this->getCurriculumsProperty();
        $data['questions'] = $this->getQuestionsProperty();

        return view('livewire.community.community-index', $data);
    }

    public function getCurriculumsProperty()
    {
        $data = Curriculum::where('status', 1)
            ->with('user')
            ->withCount('favorite')
            ->orderBy('favorite_count', 'desc');

        $data = $this->searchHelper($data, $this->paramsCurriculum['search'], ['prompt']);

        $data = $data->paginate($this->paramsCurriculum['limit'] ?? 10);

        return $data;
    }

    public function getQuestionsProperty()
    {
        $data = Question::where('status', 1)
            ->with('user')
            ->withCount('favorite')
            ->orderBy('favorite_count', 'desc');

        $data = $this->searchHelper($data, $this->paramsQuestion['search'], ['prompt']);

        $data = $data->paginate($this->paramsQuestion['limit'] ?? 10);

        return $data;
    }

    public function loadMoreCurriculum()
    {
        $this->paramsCurriculum['limit'] += 10;
    }

    public function loadMoreQuestion()
    {
        $this->paramsQuestion['limit'] += 10;
    }
}
