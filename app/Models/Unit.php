<?php

namespace App\Models;

use App\Observers\UnitObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;

#[ObservedBy([UnitObserver::class])]

class Unit extends Model implements AuditableContract
{
    use HasFactory;
    use AuditableTrait;
    protected $fillable = ['nome_fantasia', 'razao_social', 'cnpj', 'flag_id'];

    public function flag(): BelongsTo
    {
        return $this->belongsTo(Flag::class, 'flag_id', 'id');
    }
    public function collaborators(): HasMany
    {
        return $this->hasMany(Collaborator::class);
    }
}
