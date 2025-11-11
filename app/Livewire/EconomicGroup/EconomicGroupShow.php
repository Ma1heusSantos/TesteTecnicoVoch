<?php

namespace App\Livewire\EconomicGroup;

use App\Models\EconomicGroup;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EconomicGroupShow extends Component
{
    public $economicGroup;
    public $search;

    public function render()
    {
        try{
            $this->economicGroup = EconomicGroup::where('nome', 'like', '%' . $this->search . '%')->get();
            return view('livewire.economic-group.economic-group-show',['economicGroup'=>$this->economicGroup]);
        }catch(Exception $e){
            Log::info($e->getMessage());
        }

    }
}