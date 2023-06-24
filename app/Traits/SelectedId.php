<?php

namespace App\Traits;

trait SelectedId
{
    public $selectedId;

    public function setSelectedId($id)
    {
        $this->selectedId = $id;
    }

    public function resetSelectedId()
    {
        $this->selectedId = null;
    }
}
