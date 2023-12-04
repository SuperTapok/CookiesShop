<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    
    public function courses(): BelongsToMany {
        return $this->belongsToMany(Course::class, 'course_theme');
    }
}
