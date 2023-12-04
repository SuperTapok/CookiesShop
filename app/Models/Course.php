<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Course extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function provider(): BelongsTo {
        return $this->belongsTo(Provider::class);
    }

    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class, 'course_theme');
    }

    public function product(): MorphOne
    {
        return $this->morphOne(Product::class, 'typeable');
    }
}
