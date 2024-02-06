<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function position(): BelongsTo {
        return $this->belongsTo(Position::class);
    }

    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'employee_activity')->withPivot('given_at');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favourite');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
