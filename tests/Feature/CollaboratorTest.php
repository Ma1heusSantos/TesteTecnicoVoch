<?php

namespace Tests\Feature;

use App\Models\Collaborator;
use App\Models\EconomicGroup;
use App\Models\Flag;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CollaboratorTest extends TestCase
{
     /**
     * Testa a criação de um colaborador.
     *
     * @return void
     */
    public function test_create_collaborator()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $economicGroup =  EconomicGroup::factory()->create();
        $flag =  Flag::factory()->create();
        $unit =  Unit::factory()->create();

        Livewire::test('collaborator.collaborator-form')
            ->set('nome', 'john snow')
            ->set('email', 'johnSnow@hotmail.com')
            ->set('cpf', '000.000.000-00')
            ->set('unit', $unit->id)
            ->call('submit')
            ->assertRedirect(route('collaborator.show'))
            ->assertSessionHas('global-success', true)
            ->assertSessionHas('message', 'Colaborador criado com sucesso!');
    }

       /**
     * Testa a criação de um collaborador com inputs nulos (caso de erro).
     *
     * @return void
     */

     public function test_validate_inputs_required()
     {
         $user = User::factory()->create();
         $this->actingAs($user);
         $unit = Unit::factory()->create();
 
         Livewire::test('collaborator.collaborator-form')
             ->set('nome', null)
             ->set('email', null)
             ->set('cpf', null)
             ->set('unit', null)
             ->call('submit')
             ->assertHasErrors(['nome' => 'required','email' => 'required','cpf' => 'required','unit' => 'required']); 
     }
 
        /**
      * Testa a criação de um colaborador com um cpf já existente (caso de erro).
      *
      * @return void
      */
 
     public function test_create_unit_with_duplicate_name_and_cnpj()
     {
         $user = User::factory()->create();
         $this->actingAs($user);
         $unit = Unit::factory()->create(); 
 
         Livewire::test('collaborator.collaborator-form')
             ->set('nome', 'john snow')
             ->set('email', 'johnSnow@hotmail.com')
             ->set('cpf', '000.000.000-00')
             ->set('unit', $unit->id)
             ->call('submit')
             ->set('nome', 'john snow')
             ->set('email', 'johnSnow@hotmail.com')
             ->set('cpf', '000.000.000-00')
             ->set('unit', $unit->id)
             ->call('submit') 
 
             ->assertHasErrors(['cpf' => 'unique:collaborators,cpf']); 
     }
 

 
        /**
      * Testa a atualização de um colaborador com um cpf já existente.
      *
      * @return void
      */
 
     public function test_update_collaborator_with_duplicate_cpf()
     {
         $user = User::factory()->create();
         $this->actingAs($user);
         $unit = Unit::factory()->create();
         $collaborator = Collaborator::factory()->create();
 
         Livewire::test('collaborator.collaborator-edit',['collaborator'=>$collaborator])
             ->set('nome', 'john snow')
             ->set('email', 'johnSnow@hotmail.com')
             ->set('cpf', '000.000.000-00')
             ->set('unit', $unit->id)
             ->call('submit')
             ->set('nome', 'john snow')
             ->set('email', 'johnSnow@hotmail.com')
             ->set('cpf', '000.000.000-00')
             ->set('unit', $unit->id)
             ->call('submit') 
 
             ->assertHasErrors(['cpf' => 'unique:collaborators,cpf']); 
     }

     
}