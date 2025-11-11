<?php

namespace App\Livewire\Flag;

use App\Models\Flag;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class FlagShow extends Component
{
   
    public $flag;
    public $search;

    public function render()
    {
       try{
            $this->flag = Flag::where('nome', 'like', '%' . $this->search . '%')
               ->orWhereHas('economicGroup', function ($query) {
                  $query->where('nome', 'like', '%' . $this->search . '%');
               })->get();

            return view('livewire.flag.flag-show',['flag'=>$this->flag]);
       }catch(Exception $e){
            Log::info($e->getMessage());
       }
    }
}