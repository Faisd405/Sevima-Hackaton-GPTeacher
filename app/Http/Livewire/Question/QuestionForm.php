<?php

namespace App\Http\Livewire\Question;

use App\Models\Question;
use App\Traits\WithOpenAPI;
use Livewire\Component;

class QuestionForm extends Component
{
    use WithOpenAPI;

    public $prompt;

    public $titlePrompt;

    public $response;

    public $loading = false;

    protected $rules = [
        'prompt' => 'required',
    ];

    protected $attributes = [
        'prompt' => 'Prompt',
    ];

    public function render()
    {
        return view('livewire.question.question-form');
    }

    public function generate()
    {
        $this->validate();

        $prompt = "i want to ask about {$this->prompt} and the answer is";

        $openApi = $this->generatePromptOpenAPI($prompt);

        $this->titlePrompt = $this->prompt;
        $this->response = $openApi;

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Generated!',
        ]);

        $this->dispatchBrowserEvent('finished');
    }

    public function saveQuestion()
    {
        Question::create([
            'prompt' => $this->titlePrompt,
            'response' => $this->response,
            'user_id' => auth()->id(),
        ]);

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Question saved!',
        ]);

        $this->reset();
    }
}
