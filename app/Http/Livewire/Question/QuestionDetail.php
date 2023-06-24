<?php

namespace App\Http\Livewire\Question;

use App\Models\Question;
use Livewire\Component;

class QuestionDetail extends Component
{
    public $questionId;

    public function mount($id)
    {
        $this->questionId = $id;
    }

    public function render()
    {
        $data['question'] = $this->getQuestionProperty($this->questionId);

        return view('livewire.question.question-detail', $data)->extends('layouts.app');
    }

    public function getQuestionProperty($id)
    {
        $question = Question::find($id);

        return $question;
    }
}
