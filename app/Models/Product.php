<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function typeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'product_image');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'favourite');
    }
    
}
