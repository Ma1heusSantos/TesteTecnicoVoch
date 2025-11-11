<?php

namespace App\Observers;

use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UnitObserver
{
    /**
     * Handle the Unit "created" event.
     */
    public function created(Unit $unit): void
    {
        $this->sendRegisterToLog($unit,'Criou');
    }

    /**
     * Handle the Unit "updated" event.
     */
    public function updated(Unit $unit): void
    {
        $this->sendRegisterToLog($unit,'Atualizou');
    }

    /**
     * Handle the Unit "deleted" event.
     */
    public function deleted(Unit $unit): void
    {
       $this->sendRegisterToLog($unit,'Deletou');
    }

    /**
     * Handle the Unit "restored" event.
     */
    public function restored(Unit $unit): void
    {
        //
    }

    /**
     * Handle the Unit "force deleted" event.
     */
    public function forceDeleted(Unit $unit): void
    {
        //
    }

    public function sendRegisterToLog(Unit $unit,String $verb){
        Log::info("Usuário ". Auth::user()->email .' ' .$verb.' a unidade com os seguintes dados: ' . 
            'nome_fantasia: ' . $unit->nome_fantasia . ', ' .
            'razao_social: ' . $unit->razao_social . ', ' .
            'cnpj: ' . $unit->cnpj . ', ' .
            'flag ID: ' . $unit->flag_id
        );
    }
}