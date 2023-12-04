<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }

    public function product(): MorphOne
    {
        return $this->morphOne(Product::class, 'typeable');
    }
}
