<?php

namespace Tests\Feature;

use App\Models\EconomicGroup;
use App\Models\Flag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FlagTest extends TestCase
{
      /**
     * testa a criação de uma nova bandeira.
     */

    public function test_create_flag()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $economicGroup = EconomicGroup::factory()->create();        
            Livewire::test('flag.flag-form')
                ->set('nome', 'Bandeira do brasil')
                ->set('group', $economicGroup->id)
                ->call('submit')
                ->assertRedirect(route('flag.show'))
                ->assertSessionHas('global-success', true)
                ->assertSessionHas('message', 'Bandeira criada com sucesso!');
    }


      /**
     * Testa a criação de uma bandeira com nome e grupo economico nulo (caso de erro).
     *
     * @return void
     */

    public function test_validate_nome_and_group_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Livewire::test('flag.flag-form')
            ->set('nome', '')
            ->set('group', '')  
            ->call('submit')
            ->assertHasErrors(['nome' => 'required','group' => 'required']); 
    }


      /**
     * Testa a criação de uma bandeira com um nome já existente (caso de erro).
     *
     * @return void
     */

    public function test_create_flag_with_duplicate_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $economicGroup = EconomicGroup::factory()->create();  

        Livewire::test('flag.flag-form')
            ->set('nome', 'Bandeira do brasil')
            ->set('group', $economicGroup->id) 
            ->call('submit')
            ->set('nome', 'Bandeira do brasil')
            ->set('group', $economicGroup->id) 
            ->call('submit')
            ->assertHasErrors(['nome' => 'unique:flags,nome']); 
    }


      /**
     * Testa se é possivel editar um bandeira.
     *
     * @return void
     */

    public function test_update_flag()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $economicGroup = EconomicGroup::factory()->create();
        $flag = Flag::factory()->create();
        $newNome = 'Bandeira';
        Livewire::test('flag.flag-edit', ['flag' => $flag])
        ->set('nome', $newNome)
        ->set('group', $economicGroup->id)
        ->call('submit')
        ->assertRedirect(route('flag.show')) 
        ->assertSessionHas('message', 'Bandeira editada com sucesso!');
    }


    /**
     * Testa se é possivel editar um bandeira com um nome nulo.
     *
     * @return void
     */

    public function test_update_flag_with_null_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $flag = Flag::factory()->create();
        $economicGroup = EconomicGroup::factory()->create();
        Livewire::test('flag.flag-edit', ['flag' => $flag])
            ->set('nome', null)
            ->set('group', $economicGroup->id)
            ->call('submit')   
            ->assertSessionHas('message', 'Bandeira editada com sucesso!');
    }

   /**
     * Testa se é possivel editar um bandeira com um grupo economico nulo.
     *
     * @return void
     */

    public function test_update_flag_with_null_economicGroup()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $flag = Flag::factory()->create();

        Livewire::test('flag.flag-edit', ['flag' => $flag])
            ->set('nome', 'bandeira do brasil')
            ->set('group', null)
            ->call('submit')   
            ->assertSessionHas('message', 'Bandeira editada com sucesso!');
    }
}