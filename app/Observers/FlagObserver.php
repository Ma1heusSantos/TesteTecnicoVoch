<?php

namespace App\Observers;

use App\Models\Flag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FlagObserver
{
    /**
     * Handle the Flag "created" event.
     */
    public function created(Flag $flag): void
    {
        $this->sendRegisterToLog($flag,'Criou');
    }

    /**
     * Handle the Flag "updated" event.
     */
    public function updated(Flag $flag): void
    {
        $this->sendRegisterToLog($flag,'Atualizou');
    }

    /**
     * Handle the Flag "deleted" event.
     */
    public function deleted(Flag $flag): void
    {
        $this->sendRegisterToLog($flag,'Deletou');
    }

    /**
     * Handle the Flag "restored" event.
     */
    public function restored(Flag $flag): void
    {
        //
    }

    /**
     * Handle the Flag "force deleted" event.
     */
    public function forceDeleted(Flag $flag): void
    {
        //
    }

    public function sendRegisterToLog(Flag $flag,string $verb){
        Log::info("Usuário ". Auth::user()->email .' '.$verb.' uma Bandeira com os seguintes dados: ' . 
            'nome: ' . $flag->nome . ', ' .
            'economic_group_id: ' . $flag->economic_group_id . ', ' 
        );
    }
}