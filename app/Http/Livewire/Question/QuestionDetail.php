<?php

namespace App\Http\Livewire\Question;

use App\Models\Question;
use Livewire\Component;

class QuestionDetail extends Component
{
    public $question;

    public function mount($id)
    {
        $this->question = $this->getQuestionProperty($id);
    }

    public function render()
    {
        $data['question'] = $this->question;

        return view('livewire.question.question-detail', $data)->extends('layouts.app');
    }

    public function getQuestionProperty($id)
    {
        $question = Question::find($id);

        return $question;
    }
}
