<?php

namespace App\Observers;

use App\Models\Collaborator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CollaboratorObserver
{
    /**
     * Handle the Collaborator "created" event.
     */
    public function created(Collaborator $collaborator): void
    {
        $this->sendRegisterToLog($collaborator,'Criou');
    }

    /**
     * Handle the Collaborator "updated" event.
     */
    public function updated(Collaborator $collaborator): void
    {
        $this->sendRegisterToLog($collaborator,'Atualizou');
    }

    /**
     * Handle the Collaborator "deleted" event.
     */
    public function deleted(Collaborator $collaborator): void
    {
        $this->sendRegisterToLog($collaborator,'Deletou');
    }

    /**
     * Handle the Collaborator "restored" event.
     */
    public function restored(Collaborator $collaborator): void
    {
        //
    }

    /**
     * Handle the Collaborator "force deleted" event.
     */
    public function forceDeleted(Collaborator $collaborator): void
    {
        //
    }

    public function sendRegisterToLog(Collaborator $collaborator,string $verb){
        Log::info("Usuário ". Auth::user()->email .''.$verb.'  o colaborador com os seguintes dados: ' . 
            'Nome: ' . $collaborator->nome . ', ' .
            'Email: ' . $collaborator->email . ', ' .
            'CPF: ' . $collaborator->cpf . ', ' .
            'unit ID: ' . $collaborator->unit
        );
    }
}