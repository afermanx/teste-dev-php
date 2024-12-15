<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'fantasy_name',
        'document',
        'address',
        'phone',
    ];
    /**
     * Get the attributes that should be cast.
     * @return array
     */
    protected function casts(): array
    {
        return [
            'document' => 'json',
            'address' => 'json',
            'phone' => 'json',
        ];
    }


    /**
     *  Relationship with users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}