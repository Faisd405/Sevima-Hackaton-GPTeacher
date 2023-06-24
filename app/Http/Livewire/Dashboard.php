<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data['questions'] = $this->getQuestionUser();

        return view('livewire.dashboard', $data)->extends('layouts.app');
    }

    public function getQuestionUser()
    {
        $question = Question::where('user_id', auth()->id())->latest()->limit(8)->get();

        return $question;
    }
}
