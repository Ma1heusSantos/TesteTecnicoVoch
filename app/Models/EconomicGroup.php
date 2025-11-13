<?php

namespace App\Models;

use App\Observers\EconomicGroupObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;

#[ObservedBy([EconomicGroupObserver::class])]
class EconomicGroup extends Model implements AuditableContract
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = ['nome'];

    public function flags(): HasMany
    {
        return $this->hasMany(Flag::class);
    }
}
