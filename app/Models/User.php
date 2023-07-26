<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const LANGUES=[
        'en'=>'english',
        'fr'=>'francais',
        'ar'=>'arabe',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'country',
        'about'
    ];
    

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopeUsersActive(Builder $query) {
        return $query->withCount('posts')->orderBy('posts_count','desc');
    }
    public function scopeUserPosts(Builder $query) {
        return $query->with(['user' => function($qry){
            $qry->where('deleted_at','!=',null);
        }] );
    }
    // public function scopeUsersActiveInLastMonth(Builder $query) {
    //     return $query->withCount(['posts' => function($qry){
    //         $qry->whereBetween(static::CREATED_AT,[now()->subMonths(1),now()]);
    //     }] )
    //     ->having('posts_count','>',3)
    //     ->orderBy('posts_count','desc');
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot() {
        parent::boot();

       
        static::deleting(function(User $user){
        $user->posts()->delete();
         });

    }

}
