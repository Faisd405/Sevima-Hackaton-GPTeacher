<?php

namespace App\Http\Livewire\Curriculum;

use App\Jobs\GenerateCurriculumContent;
use App\Models\Curriculum;
use App\Models\CurriculumDetail;
use App\Traits\WithOpenAPI;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;

class CurriculumForm extends Component
{
    use WithOpenAPI;

    public $prompt;

    public $language;

    public $titlePrompt;

    public $response;

    public $curriculumData;

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
        with a description of {$this->prompt} and list structure just numbers and titles without content.
        explain in {$language} language.
        example:
        description: curriculum description \n
        1. curriculum 1 \n
        2. curriculum 2 \n
        3. curriculum 3";

        $openApi = $this->generatePromptOpenAPI($prompt);

        $this->titlePrompt = $this->prompt;
        $this->response = $openApi;

        $curriculumData = $this->makeArray($this->response);
        $this->curriculumData = $curriculumData;

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Generated!',
        ]);

        $this->dispatchBrowserEvent('finished');
    }

    public function saveCurriculum()
    {
        $curriculum = Curriculum::create([
            'prompt' => $this->titlePrompt,
            'description' => $this->curriculumData['description'],
            'language' => $this->language ?? 'english',
            'user_id' => auth()->id(),
        ]);

        $batch = Bus::batch([])
            ->name('Generate Curriculum Content')
            ->dispatch();

        $curriculumDetail = [];
        foreach ($this->curriculumData['curriculum'] as $key => $value) {
            $curriculumDetail = CurriculumDetail::create([
                'curriculum_id' => $curriculum->id,
                'title' => $value,
                'order' => $key + 1,
            ]);

            $batch->add(new GenerateCurriculumContent($curriculumDetail['id']));
        }

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Saved!',
        ]);

        $this->reset();
    }

    private function makeArray($curriculumText)
    {
        $curriculum = explode("\n", $curriculumText);

        // get description
        $description = $this->getDescription($curriculumText);

        // remove description text
        unset($curriculum[0]);

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

        // remove empty array
        $curriculum = array_filter($curriculum);

        // Fix array index
        $curriculum = array_values($curriculum);

        return [
            'description' => $description,
            'curriculum' => $curriculum,
        ];
    }

    private function getDescription($curriculumText)
    {
        $curriculum = explode("\n", $curriculumText);

        // get description
        $description = $curriculum[0];

        // remove description or Description text with preg_match
        $pattern = '/^(description|Description)\:\s+/m';
        $description = preg_replace($pattern, '', $description);
        $brLine = '<br />';
        $description = str_replace($brLine, '', $description);

        return $description;
    }
}
