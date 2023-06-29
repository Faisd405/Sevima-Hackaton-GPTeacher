<?php

namespace App\Http\Livewire\Curriculum;

use App\Models\Curriculum;
use App\Models\CurriculumDetail as ModelsCurriculumDetail;
use App\Traits\SanitizeString;
use App\Traits\WithOpenAPI;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class CurriculumDetail extends Component
{
    use WithOpenAPI, SanitizeString;

    public $curriculumId;
    public $curriculumDetailData;

    public $comment;

    public $configCurriculum = [
        'status' => 'private',
    ];

    public $curriculum;

    public $isFavorite = false;

    public function mount($id)
    {
        $this->curriculumId = $id;
        $this->curriculum = $this->getCurriculumProperty($this->curriculumId);

        $this->configCurriculum = $this->curriculum;
    }

    public function render()
    {
        $this->isFavorite = $this->isFavorite();

        return view('livewire.curriculum.curriculum-detail');
    }

    public function getCurriculumProperty($id)
    {
        $curriculum = Curriculum::with('curriculumDetails', 'comment.user.profile')
            ->withCount('favorite')->find($id);

        if ($curriculum == null) {
            session()->flash('error', 'Curriculum not found.');
            return redirect()->route('dashboard');
        }

        if ($curriculum->status == 0 && $curriculum->user_id != auth()->user()->id) {
            session()->flash('error', 'Curriculum is private.');
            return redirect()->route('dashboard');
        }

        return $curriculum->toArray();
    }

    public function getCurriculumDetailProperty($id)
    {
        if ($id == null) {
            return;
        }

        $curriculumDetail = ModelsCurriculumDetail::find($id);

        $this->curriculumDetailData = $curriculumDetail;
        $this->curriculumDetailData['content'] = $this->SanitizeString($curriculumDetail->content);

        return $curriculumDetail;
    }

    public function saveConfigCurriculum()
    {
        $curriculum = Curriculum::find($this->curriculumId);

        $curriculum->status = $this->configCurriculum['status'];

        $curriculum->save();

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Curriculum updated successfully.',
        ]);
    }

    public function favoriteCurriculum()
    {
        $curriculum = Curriculum::find($this->curriculumId);

        if ($curriculum->favorite()->where('user_id', auth()->user()->id)->count() > 0) {
            $curriculum->favorite()->where('user_id', auth()->user()->id)->delete();

            $this->dispatchBrowserEvent('toaster', [
                'type' => 'success',
                'message' => 'Curriculum unfavorited successfully.',
            ]);

            return;
        }

        $curriculum->favorite()->create([
            'user_id' => auth()->user()->id,
        ]);

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Curriculum favorited successfully.',
        ]);

        $this->curriculum = $this->getCurriculumProperty($this->curriculumId);
    }

    public function isFavorite()
    {
        $curriculum = Curriculum::find($this->curriculumId);

        if ($curriculum->favorite()->where('user_id', auth()->user()->id)->count() > 0) {
            return true;
        }

        return false;
    }

    public function commentCurriculum()
    {
        $curriculum = Curriculum::find($this->curriculumId);

        $curriculum->comment()->create([
            'user_id' => auth()->user()->id,
            'comment' => $this->comment,
        ]);

        $this->comment = null;

        $this->curriculum = $this->getCurriculumProperty($this->curriculumId);

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Comment added successfully.',
        ]);
    }
}
