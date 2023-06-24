<?php

namespace App\Http\Livewire;

use App\Models\Curriculum;
use App\Models\Question;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data['questions'] = $this->getQuestion();
        $data['curriculums'] = $this->getCurriculum();

        return view('livewire.dashboard', $data)->extends('layouts.app');
    }

    public function getQuestion()
    {
        $question = Question::where('user_id', auth()->id())
            ->latest()
            ->limit(8)
            ->get();

        return $question;
    }

    public function getCurriculum()
    {
        $curriculum = Curriculum::where('user_id', auth()->id())
            ->latest()
            ->limit(8)
            ->with('curriculumDetails')
            ->get();

        return $curriculum;
    }
}
