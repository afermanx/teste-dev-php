<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Supplier extends Model
{
    use HasFactory, SoftDeletes;
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
