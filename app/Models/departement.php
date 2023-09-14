<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class departement extends Model
{
    use HasFactory;
    public function chefDep():BelongsTo{
        return $this->belongsTo(chefdep::class);
    }

    public function filiere():HasMany{
        return $this->hasMany(filiere::class);
    }
}
