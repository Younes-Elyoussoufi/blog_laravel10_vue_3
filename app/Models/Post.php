<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Scopes\LatestPost;
use App\Models\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\AdminShowTtrashedPosts;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'title',
        'content',
        'user_id',
        'category_id',
        'image',
    ];
    // protected $hidden=[
    //     'deleted_at',
    //     'created_at',
       
    // ];

    public function comments(){
        return $this->hasMany(Comment::class)->dernier();
    }
    


    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id')->withTimestamps();
    }

    public function scopeMostCommented(Builder $query) {
        return $query->withCount('comments')->with('user')->orderBy('comments_count','desc');
    }

    public function scopePostsWithCommentsTagsUsers(Builder $query) {
        return $query->withCount('comments')->with(['user','tags']);
    }
    public function scopePostsUsersNoTrashed(Builder $query) {
        return $query->with(['user' => function($qry){
            $qry->where('deleted_at','<>',null);
        }] );
    }
    
    public static function boot() {
        //  static::addGlobalScope(new AdminShowTtrashedPosts);

        parent::boot();

         static::addGlobalScope(new LatestPost);
        
        // static::deleting(function(Post $post){
        // $post->comments()->delete();
        //  });
        //  static::restoring(function(Post $post){
        //     $post->comments()->restore();
        //      });  
    }

    protected $appends=['published'];

    public function getPublishedAttribute(){
        
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();

    }
}
