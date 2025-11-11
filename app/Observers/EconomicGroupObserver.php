<?php

namespace App\Observers;

use App\Models\EconomicGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EconomicGroupObserver
{
    /**
     * Handle the EconomicGroup "created" event.
     */
    public function created(EconomicGroup $economicGroup): void
    {
        $this->sendRegisterToLog($economicGroup,'Criou');
    }

    /**
     * Handle the EconomicGroup "updated" event.
     */
    public function updated(EconomicGroup $economicGroup): void
    {
        $this->sendRegisterToLog($economicGroup,'Atualizou');
    }

    /**
     * Handle the EconomicGroup "deleted" event.
     */
    public function deleted(EconomicGroup $economicGroup): void
    {
        $this->sendRegisterToLog($economicGroup,'excluiu');
    }
    

    /**
     * Handle the EconomicGroup "restored" event.
     */
    public function restored(EconomicGroup $economicGroup): void
    {
        //
    }

    /**
     * Handle the EconomicGroup "force deleted" event.
     */
    public function forceDeleted(EconomicGroup $economicGroup): void
    {
        //
    }


    public function sendRegisterToLog(EconomicGroup $economicGroup,String $verb){
        Log::info("Usuário ". Auth::user()->email .' '. $verb .' um Grupo economico com os seguintes dados: ' . 
            'economicGroup: ' . $economicGroup->nome . ', ' 
        );
    }
}