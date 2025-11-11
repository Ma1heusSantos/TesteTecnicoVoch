<?php

namespace App\Livewire\Flag;

use App\Models\EconomicGroup;
use App\Models\Flag;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FlagForm extends Component
{
    public $nome;
    public $economicGroup;
    public $group;

    protected $rules = [
        'nome' => 'required|string|max:255|unique:flags,nome',
        'group'=> 'required'
    ];

    public function mount()
    {
        $this->economicGroup = EconomicGroup::all();
    }

    public function submit()
    {
        $this->validate();
        
        try{
            Flag::create([
                'nome' => $this->nome,
                'economic_group_id'=> $this->group
            ]);
  
            session()->flash('global-success',true);
            session()->flash('message', 'Bandeira criada com sucesso!');
            return redirect()->route('flag.show');
        }catch(Exception $e){
            Log::info($e->getMessage());
            session()->flash('global-error',true);
        }
        
    }
    public function render()
    {
        return view('livewire.flag.flag-form');
    }
}