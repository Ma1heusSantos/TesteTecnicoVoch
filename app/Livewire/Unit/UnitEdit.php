<?php

namespace App\Livewire\Unit;

use App\Models\Flag;
use App\Models\Unit;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UnitEdit extends Component
{
    
    public $nomeFantasia;
    public $razaoSocial;
    public $cnpj;
    public $flags;
    public $flag;
    public $unit;

    protected $rules = [
        'nomeFantasia' => 'nullable|string|max:255',
        'razaoSocial'=> 'nullable|string|max:255',
        'cnpj'=> 'nullable|unique:units,cnpj'
    ];

    public function submit()
    {
        $this->validate();
        try{
            $unit = Unit::findOrFail($this->unit->id);

            $campos = [
             'nome_fantasia' => !empty($this->nomeFantasia) ?  $this->nomeFantasia : $unit->nome_fantasia,
             'razao_social' => !empty($this->razaoSocial) ? $this->razaoSocial : $unit->razao_social,
             'cnpj'=> !empty($this->cnpj) ? $this->cnpj : $unit->cnpj,
             'flag_id'=>!empty($this->flag) ? $this->flag : $unit->flag_id,
         ];
            $unit->update($campos);
            
            session()->flash('global-success',true);
            session()->flash('message', 'Unidade editada com sucesso!');
             return redirect()->route('unit.show');
        }catch(Exception $e){
            Log::info($e->getMessage());
            session()->flash('global-error',true);
        }
    }

  
    public function mount($unit){
        $this->nomeFantasia = $unit->nome_fantasia;
        $this->razaoSocial = $unit->razao_social;
        $this->flag = $unit->flag_id;
        $this->flags = Flag::all();
    }
    public function render()
    {
        return view('livewire.unit.unit-edit');
    }
}