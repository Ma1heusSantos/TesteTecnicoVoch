<?php

namespace App\Livewire\Collaborator;

use App\Models\Collaborator;
use App\Models\Unit;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CollaboratorEdit extends Component
{
    public $nome;
    public $collaborator;
    public $email;
    public $cpf;
    public $units;
    public $unit;

    protected $rules = [
        'nome' => 'nullable|string|max:255',
        'email' => 'nullable|email|string|max:255',
        'cpf' => 'nullable'
    ];

    public function submit()
    {
        $this->validate();
        try {

            $collaborator = Collaborator::find($this->collaborator->id);
            $campos = [
                'nome' => !empty($this->nome) ?  $this->nome : $collaborator->nome,
                'email' => !empty($this->email) ? $this->email : $collaborator->email,
                'cpf' => !empty($this->cpf) ? $this->cpf : $collaborator->cpf,
                'unit_id' => !empty($this->unit) ? $this->unit : $collaborator->unit_id,
            ];
            $collaborator->update($campos);


            return redirect()->route('collaborator.show');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            session()->flash('global-error', true);
        }
    }


    public function mount($collaborator)
    {
        $this->nome = $collaborator->nome;
        $this->email = $collaborator->email;
        $this->cpf = $collaborator->cpf;
        $this->unit = $collaborator->unit_id;
        $this->units = Unit::all();
    }
    public function render()
    {
        return view('livewire.collaborator.collaborator-edit');
    }
}
