<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AuditFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $event = '';
    public $user = '';
    public $date_from = '';
    public $date_to = '';

    protected $updatesQueryString = ['search', 'event', 'user', 'date_from', 'date_to'];

    public function updating($property)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = DB::table('audits')
            ->leftJoin('users', 'audits.user_id', '=', 'users.id')
            ->select(
                'audits.*',
                'users.name as user_name'
            );

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('event', 'like', "%{$this->search}%")
                    ->orWhere('url', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%");
            });
        }

        if ($this->event) {
            $query->where('event', $this->event);
        }

        if ($this->user) {
            $query->where('users.id', $this->user);
        }

        if ($this->date_from) {
            $query->whereDate('audits.created_at', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->whereDate('audits.created_at', '<=', $this->date_to);
        }

        $audits = $query->orderBy('audits.id', 'desc')->paginate(20);

        $users = DB::table('users')->select('id', 'name')->get();

        return view('livewire.audit-filter', compact('audits', 'users'));
    }
}
