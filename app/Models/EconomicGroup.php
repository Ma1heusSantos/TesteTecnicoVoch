<?php

namespace App\Models;

use App\Observers\EconomicGroupObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
#[ObservedBy([EconomicGroupObserver::class])]


class EconomicGroup extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];


    public function flags(): HasMany
    {
        return $this->hasMany(Flag::class);
    }
}