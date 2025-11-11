<?php

namespace App\Exports;

use App\Models\Collaborator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CollaboratorExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Carrega os colaboradores com suas unidades
        return Collaborator::with('unit')->get();
    }

    /**
     * Definir os cabeçalhos da planilha
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nome',             
            'Email',              
            'CPF',                
            'Unidade',            
            'Data de Criação',    
            'Última Atualização', 
        ];
    }

    /**
     * Mapear os dados para a exportação
     *
     * @param  \App\Models\Collaborator  $collaborator
     * @return array
     */
    public function map($collaborator): array
    {
        return [
            $collaborator->nome,              
            $collaborator->email,            
            $collaborator->cpf,              
            $collaborator->unit->nome_fantasia ?? 'Sem unidade',  
            $collaborator->created_at,       
            $collaborator->updated_at,        
        ];
    }
}