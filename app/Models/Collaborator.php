<?php

namespace App\Models;

use App\Observers\CollaboratorObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
#[ObservedBy([CollaboratorObserver::class])]


class Collaborator extends Model
{
    use HasFactory;
    protected $fillable = ['nome','email','cpf','unit_id'];
    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
}