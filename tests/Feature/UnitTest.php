<?php

namespace Tests\Feature;

use App\Models\Flag;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UnitTest extends TestCase
{
    /**
     * testa a criação de uma nova unidade.
     */

    public function test_create_unit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $flag = Flag::factory()->create();

        Livewire::test('unit.unit-form')
            ->set('nomeFantasia', 'Voch Tecnologia e Sistemas de Informacao Ltda')
            ->set('razaoSocial', 'Voch Tech')
            ->set('cnpj', '19.979.567/0001-80')
            ->set('flag', $flag->id)
            ->call('submit')
            ->assertRedirect(route('unit.show'))
            ->assertSessionHas('global-success', true)
            ->assertSessionHas('message', 'Unidade criada com sucesso!');
    }

        /**
     * Testa a criação de uma bandeira com inputs nulos (caso de erro).
     *
     * @return void
     */

    public function test_validate_nome_and_group_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Livewire::test('unit.unit-form')
        ->set('nomeFantasia', null)
        ->set('razaoSocial', null)
        ->set('cnpj', null)
        ->set('flag', null) 
            ->call('submit')
            ->assertHasErrors(['nomeFantasia' => 'required','razaoSocial' => 'required','cnpj' => 'required','flag' => 'required']); 
    }

       /**
     * Testa a criação de uma bandeira com um cnpj já existente (caso de erro).
     *
     * @return void
     */

    public function test_create_unit_with_duplicate_name_and_cnpj()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $flag = flag::factory()->create(); 

        Livewire::test('unit.unit-form')
            ->set('nomeFantasia', 'Voch Tecnologia e Sistemas de Informacao Ltda')
            ->set('razaoSocial', 'Voch Tech')
            ->set('cnpj', '05.975.665/0001-71')
            ->set('flag', $flag->id)
            ->call('submit')
            ->set('nomeFantasia', 'Voch Tecnologia e Sistemas de Informacao Ltda')
            ->set('razaoSocial', 'Voch Tech')
            ->set('cnpj', '05.975.665/0001-71')
            ->set('flag', $flag->id)
            ->call('submit') 

            ->assertHasErrors(['cnpj' => 'unique:units,cnpj']); 
    }


       /**
     * Testa a atualização de uma unidade .
     *
     * @return void
     */

    public function test_update_unit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $unit = Unit::factory()->create();

        Livewire::test('unit.unit-edit',['unit'=>$unit])
        ->set('nomeFantasia', 'Voch Tecnologia e Sistemas de Informacao Ltda')
        ->set('razaoSocial', 'Voch Tech')
        ->set('cnpj', '05.975.665/0001-76')
        ->call('submit')
        ->assertRedirect(route('unit.show')) 
        ->assertSessionHas('message', 'Unidade editada com sucesso!');
    }

       /**
     * Testa a atualização de uma unidade com um cnpj já existente.
     *
     * @return void
     */

    public function test_create_unit_with_duplicate_cnpj()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $unit = Unit::factory()->create();

        Livewire::test('unit.unit-edit',['unit'=>$unit])
            ->set('nomeFantasia', 'Voch Tecnologia e Sistemas de Informacao Ltda')
            ->set('razaoSocial', 'Voch Tech')
            ->set('cnpj', '05.975.665/0001-71')
            ->call('submit')
            ->set('nomeFantasia', 'Voch Tecnologia e Sistemas de Informacao Ltda')
            ->set('razaoSocial', 'Voch Tech')
            ->set('cnpj', '05.975.665/0001-71')
            ->call('submit') 

            ->assertHasErrors(['cnpj' => 'unique:units,cnpj']); 
    }
    
    
}