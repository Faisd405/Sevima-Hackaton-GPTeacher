<?php

namespace App\Jobs;

use App\Models\CurriculumDetail;
use App\Traits\SanitizeString;
use App\Traits\WithOpenAPI;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateCurriculumContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    use SanitizeString, WithOpenAPI;

    public $curriculumDetail;

    /**
     * Create a new job instance.
     */
    public function __construct($curriculumDetailId)
    {
        $this->curriculumDetail = CurriculumDetail::find($curriculumDetailId);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $prompt = "explain {$this->curriculumDetail->title} in the {$this->curriculumDetail->language} language. give an example and explain it. make the text into markdown format.";

        $openApi = $this->generatePromptOpenAPI($prompt);

        $openApi = $this->SanitizeString($openApi);

        $this->curriculumDetail->content = $openApi;

        $this->curriculumDetail->save();

        sleep(3);
    }
}
