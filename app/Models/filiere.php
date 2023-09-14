<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class filiere extends Model
{
    use HasFactory;
    protected $fillable = [
        'departement_id',
        'libelle',
    ];
    public function departement():BelongsTo{
        return $this->belongsTo(departement::class);
    }

    public function classe():HasMany{
        return $this->hasMany(classe::class);
    }
}
