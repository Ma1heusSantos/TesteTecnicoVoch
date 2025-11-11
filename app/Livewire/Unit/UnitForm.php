<?php

namespace App\Livewire\Unit;

use App\Models\Flag;
use App\Models\Unit;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UnitForm extends Component
{
    public $nomeFantasia;
    public $razaoSocial;
    public $cnpj;

    public $flags;
    public $flag;

    protected $rules = [
        'nomeFantasia' => 'required|string|max:255',
        'razaoSocial'=> 'required|string|max:255',
        'cnpj'=> 'required|unique:units,cnpj',
        'flag'=>'required'
    ];
    
    public function mount()
    {
        $this->flags = Flag::all();
    }

    public function submit()
    {
        $this->validate();
        try{
            Unit::create([
                'nome_fantasia'=> $this->nomeFantasia,
                'razao_social'=> $this->razaoSocial,
                'cnpj'=> $this->cnpj,
                'flag_id'=> $this->flag
            ]);
    
            session()->flash('global-success',true);
            session()->flash('message', 'Unidade criada com sucesso!');
            return redirect()->route('unit.show');

        } catch (Exception $e) {
            Log::info("error: " . $e->getMessage());
            session()->flash('global-error',true);
        }
      
    }

  
    public function render()
    {
        return view('livewire.unit.unit-form');
    }
}