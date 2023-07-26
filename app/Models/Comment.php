<?php

namespace App\Models;

use App\Models\Post;

use App\Models\User;
use App\Models\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'content',
        'post_id',
        'user_id'
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeDernier(Builder $query) {
        return $query->orderBy(static::UPDATED_AT,'desc');
    }
    public static function boot() {
        parent::boot();

        // static::addGlobalScope(new LatestScope);

    }
}
