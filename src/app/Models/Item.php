<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'condition_id',
        'profile_id',
        'comment_id',
        'like_id',
        'name',
        'image',
        'brand_name',
        'content',
        'price',
        'url'
    ];

    protected $casts = [
        'category_id' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function is_liked_by_auth_user()
    {
        $id = Auth::id();

        $likers = array();
        if (!empty($this->likes)) {
            foreach($this->likes as $like) {
                array_push($likers, $like->user_id);
            }
        }

        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeSearch(Builder $query, ?string $keyword)
    {
        if ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        }
        return $query;
    }

    public function scopeExcludeUser(Builder $query,  $userId)
    {
        return $query->where('user_id', '!=', $userId);
    }

    public function scopeOnlyLikedBy(Builder $query,  $userId)
    {
        return $query->whereHas('likes', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }
}
