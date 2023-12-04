<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_activity')->withPivot('given_at');
    }
}
