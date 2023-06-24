<?php

namespace App\Http\Livewire\Question;

use App\Models\Question;
use Livewire\Component;

class QuestionDetail extends Component
{
    public $questionId;

    public $configQuestion = [
        'status' => 'private',
    ];

    public $question;

    public $isFavorite = false;

    public function mount($id)
    {
        $this->questionId = $id;

        $this->question = $this->getQuestionProperty($this->questionId);

        $this->configQuestion = $this->question;
    }

    public function render()
    {
        $this->isFavorite = $this->isFavorite();

        return view('livewire.question.question-detail')->extends('layouts.app');
    }

    public function getQuestionProperty($id)
    {
        $question = Question::withCount('favorite')->find($id);

        if ($question == null) {
            session()->flash('error', 'Question not found.');
            return redirect()->route('dashboard');
        }

        if ($question->status == 0 && $question->user_id != auth()->user()->id) {
            session()->flash('error', 'Question is private.');
            return redirect()->route('dashboard');
        }



        return $question->toArray();
    }

    public function saveConfigQuestion()
    {
        $question = Question::find($this->questionId);

        $question->status = $this->configQuestion['status'];

        $question->save();

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Question updated successfully.',
        ]);
    }

    public function favoriteQuestion()
    {
        $question = Question::find($this->questionId);

        if ($question->favorite()->where('user_id', auth()->user()->id)->count() > 0) {
            $question->favorite()->where('user_id', auth()->user()->id)->delete();

            $this->dispatchBrowserEvent('toaster', [
                'type' => 'success',
                'message' => 'Question unfavorited successfully.',
            ]);

            return;
        }

        $question->favorite()->create([
            'user_id' => auth()->user()->id,
        ]);

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Question favorited successfully.',
        ]);

        $this->question = $this->getQuestionProperty($this->questionId);
    }

    public function isFavorite()
    {
        $question = Question::find($this->questionId);

        if ($question->favorite()->where('user_id', auth()->user()->id)->count() > 0) {
            return true;
        }

        return false;
    }
}
