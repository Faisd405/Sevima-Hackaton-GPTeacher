<?php

namespace App\Http\Livewire\Question;

use App\Models\Question;
use App\Traits\ParamQueryHelper;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionIndex extends Component
{
    use WithPagination, ParamQueryHelper;

    public $params = [
        'limit' => 10,
        'search' => '',
    ];

    public function render()
    {
        $data['questions'] = $this->questions;

        return view('livewire.question.question-index', $data);
    }

    public function getQuestionsProperty()
    {
        $question = Question::orderBy('created_at', 'DESC');

        $question = $this->searchHelper($question, $this->params['search'], ['prompt']);

        return $question->paginate($this->params['limit'] ?? 10);
    }
}
