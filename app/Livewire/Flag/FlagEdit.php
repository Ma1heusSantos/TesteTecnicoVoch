<?php

namespace App\Livewire\Flag;

use App\Models\EconomicGroup;
use App\Models\Flag;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class FlagEdit extends Component
{
    public $group;
    public $nome;
    public $flag;
    public $economicGroup;
    
    protected $rules = [
        'nome' => 'nullable|string|max:255',
    ];
    public function submit()
    {
        $this->validate();
        try{
            $flag = Flag::find($this->flag->id);
            
            $campos = [
             'nome' => !empty($this->nome) ?  $this->nome : $flag->nome ,
             'economic_group_id' => !empty($this->group) ? $this->group : $flag->economic_group_id 
         ];
            $flag->update($campos);
     
            session()->flash('global-success',true);
            session()->flash('message', 'Bandeira editada com sucesso!');
             return redirect()->route('flag.show');
        }catch(Exception $e){
            Log::info($e->getMessage());
            session()->flash('global-error',true);
        }
    }

    public function mount($flag)
    {
        $this->group = $flag->economic_group_id;
        $this->nome = $flag->nome;
    }

  
    public function render()
    {
        $this->economicGroup = EconomicGroup::all();
        return view('livewire.flag.flag-edit');
    }
}