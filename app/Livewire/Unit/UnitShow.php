<?php

namespace App\Livewire\Unit;

use App\Models\Unit;
use Livewire\Component;

class UnitShow extends Component
{
    public $unit;
    public $search;
    public function mount()
    {
        $this->unit = Unit::all();
    }
    public function render()
    {
        $this->unit = Unit::where('nome_fantasia', 'like', '%' . $this->search . '%')
            ->orWhere('razao_social', 'like', '%' . $this->search . '%')
            ->orWhere('cnpj', 'like', '%' . $this->search . '%')
            ->orWhereHas('flag', function ($query) {
                $query->where('nome', 'like', '%' . $this->search . '%');
            })->get();
        return view('livewire.unit.unit-show');
    }
}