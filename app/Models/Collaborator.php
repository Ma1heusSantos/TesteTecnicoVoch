<?php

namespace App\Models;

use App\Observers\CollaboratorObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;


#[ObservedBy([CollaboratorObserver::class])]


class Collaborator extends Model implements AuditableContract
{
    use HasFactory;
    use AuditableTrait;
    protected $fillable = ['nome', 'email', 'cpf', 'unit_id'];
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
