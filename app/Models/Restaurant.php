<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property float $average_rating
 */
class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'average_rating',
        'address',
    ];

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function averageRating()
    {
        $avg = $this->foods()
            ->with('ratings')
            ->get()
            ->flatMap(function ($food) {
                return $food->ratings->pluck('rating');
            })->avg();
        $this->average_rating = $avg;
        $this->save();
        return $avg;
    }

}
