<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'filiere_id',
        'libelle',
    ];

    public function filiere():BelongsTo{
        return $this->belongsTo(filiere::class);
    }

    public function postulation():HasMany{
        return $this->hasMany(postulation::class);
    }
}
