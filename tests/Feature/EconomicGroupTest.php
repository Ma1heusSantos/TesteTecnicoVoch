<?php

namespace Tests\Feature;

use App\Models\EconomicGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;

class EconomicGroupTest extends TestCase
{
    
    /**
     * testa a criação de um novo grupo economico.
     */

    public function test_create_economic_group()
    {
    $user = User::factory()->create();
    $this->actingAs($user);
        
        Livewire::test('economic-group.economic-group-form')
            ->set('nome', 'Grupo Teste')
            ->call('submit')
            ->assertRedirect(route('economicGroup.show'))
            ->assertSessionHas('global-success', true)
            ->assertSessionHas('message', 'Grupo Econômico criado com sucesso!');
    }
     
     /**
     * Testa a validação de um campo obrigatório (nome).
     *
     * @return void
     */
    public function test_validate_nome_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Livewire::test('economic-group.economic-group-form')
            ->set('nome', '') 
            ->call('submit')
            ->assertHasErrors(['nome' => 'required']); 
    }

    /**
     * Testa a criação de um grupo econômico com nome já existente (caso de erro).
     *
     * @return void
     */
    public function test_create_economic_group_with_duplicate_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        EconomicGroup::create([
            'nome' => 'Grupo Econômico Existente',
        ]);

        Livewire::test('economic-group.economic-group-form')
            ->set('nome', 'Grupo Econômico Existente') 
            ->call('submit')
            ->assertHasErrors(['nome' => 'unique:economic_groups,nome']); 
    }

     /**
     * Testa a criação de um grupo econômico com nome já existente (caso de erro).
     *
     * @return void
     */
    public function test_update_economic_group()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $economicGroup = EconomicGroup::factory()->create();
        $newNome = 'Novo Nome';
        Livewire::test('economic-group.economic-group-edit', ['economicGroup' => $economicGroup])
        ->set('nome', $newNome)
        ->call('submit')
        ->assertRedirect(route('economicGroup.show')) 

        ->assertSessionHas('message', 'Grupo Econômico editado com sucesso!');
    }

      /**
     * Testa a criação de um grupo econômico com nome nulo (caso de erro).
     *
     * @return void
     */

    public function test_update_economic_group_with_null_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $economicGroup = EconomicGroup::factory()->create();
        $response = Livewire::test('economic-group.economic-group-edit', ['economicGroup' => $economicGroup])
            ->set('nome', null)
            ->call('submit')   
            ->assertHasErrors(['nome' => 'required']); 
    }
}