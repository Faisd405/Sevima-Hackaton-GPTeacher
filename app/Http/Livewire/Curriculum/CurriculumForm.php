<?php

namespace App\Http\Livewire\Curriculum;

use App\Traits\WithOpenAPI;
use Livewire\Component;

class CurriculumForm extends Component
{
    use WithOpenAPI;

    public $prompt;

    public $language;

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
        return view('livewire.curriculum.curriculum-form');
    }

    public function generate()
    {
        $this->validate();

        $language = $this->language ?? 'english';

        $prompt = "provide curriculum about {$this->prompt} and materials in each curriculum
        with a list structure just numbers and title without content with {$language} language,
        example:
        1. curriculum 1 \n
        2. curriculum 2 \n
        3. curriculum 3";

        $openApi = $this->generatePromptOpenAPI($prompt);

        $this->titlePrompt = $this->prompt;
        $this->response = $openApi;

        $curriculum = $this->makeArray($this->response);

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Generated!',
        ]);

        $this->dispatchBrowserEvent('finished');
    }

    public function makeArray($curriculumText)
    {
        $curriculum = explode("\n", $curriculumText);

        // filtering
        $curriculum = array_map(function ($item) {
            // remove number and dot
            $pattern = '/^\d+\.\s+/m';
            $item = preg_replace($pattern, '', $item);

            // remove empty line
            $item = trim($item);

            // remove <br /> line
            $brLine = '<br />';
            $item = str_replace($brLine, '', $item);

            if (empty($item)) {
                return;
            }

            return $item;
        }, $curriculum);

        // Fix array index
        $curriculum = array_values($curriculum);

        $curriculum = array_filter($curriculum);

        return $curriculum;
    }

}
