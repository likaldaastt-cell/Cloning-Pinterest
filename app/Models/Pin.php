<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pin extends Model
{
    public const CATEGORIES = ['Desain', 'Makanan', 'Travel', 'Fashion', 'Teknologi', 'Lainnya'];

    protected $fillable = ['user_id', 'board_id', 'title', 'description', 'image_url', 'category'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function likedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likedBy()->where('users.id', $user->id)->exists();
    }
}