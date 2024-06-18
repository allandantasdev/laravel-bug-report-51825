<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Example extends Model
{
    protected $fillable = ['category_id', 'name', 'restricted'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeHasAccess(Builder $query, ?User $user = null): Builder
    {
        return $query->where(
            fn ($query) => $query->where('restricted', false)
                ->when(
                    $user !== null,
                    fn($query) => $query->orWhereIn('category_id', $user->categories->pluck('id'))
                )
        );
    }
}
