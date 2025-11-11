<?php

namespace App\Livewire\Collaborator;

use App\Models\Collaborator;
use Livewire\Component;


class CollaboratorShow extends Component
{
    public $collaborators;
    public $search;
    public function render()
    {
        $this->collaborators = Collaborator::where('nome', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('cpf', 'like', '%' . $this->search . '%')
            ->orWhereHas('unit', function ($query) {
                $query->where('nome_fantasia', 'like', '%' . $this->search . '%');
            })->with('unit')->get();
        return view('livewire.collaborator.collaborator-show');
    }
}