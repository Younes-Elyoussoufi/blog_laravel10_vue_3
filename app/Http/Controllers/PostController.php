<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Exists;

class PostController extends Controller
{
 
    public function index(Request $request)
    {  
         $pagination=20;
        return response()->json([
           'posts'=>Post::withCount('comments')->with('user')->paginate($pagination),
           'mostCommented'=>Post::mostCommented()->with('user')->take(3)->get(),
           'usersActive'=>User::usersActive()->take(5)->get(),
           'categories'=>Category::withCount('posts')->get(),
           'pages_count'=>ceil(count(Post::all()) / $pagination),
           'login'=>auth()->check(),
        ]);
    }
    public function posts_profile( $user_id)
    { 
         $pagination=10;
        return response()->json([
           'posts'=>Post::with('user')->where('user_id',$user_id)->paginate($pagination),
        ]);
    
    }
    

    public function getPostsByCategory($id)
    {
        return response()->json([
           'posts'=>Post::withCount('comments')->with('user')->where('category_id',$id)
           ->paginate(10),
        ]);
    }

    public function search($search)
    {
        return response()->json([
           'posts'=>Post::withCount('comments')->with('user')->where('title','like','%'.$search.'%')->paginate(10),
        ]);
    }
    //admin posts_archive
    public function posts_archive(User $user)
    {
         $this->authorize('login',$user);
        // if(!(auth()->check() && auth()->user()->is_admin )) return;
        return response()->json([
            'posts'=>Post::onlyTrashed()->with('user')->paginate(10),
         ]);
         // 
    }
    public function fetch_archive($id)
    {
        //  $this->authorize('login');
        return response()->json([
            'posts'=>Post::onlyTrashed()->withCount('comments')->where('user_id',$id)->with('user')->paginate(10),
            'auth'=>auth()->user()
         ]);

    }
        
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,User $user)
    {
        $this->authorize('login',$user);

        $name=null;
        if ($request->has('image')){

            //    $name=$request->image->getClientOriginalName();
            //    $request->image->move(public_path('site/img/post'),$name); 
            // //    ================
               $ext=$request->image->getClientOriginalExtension();
               $name=time().'.'.$ext;
               $request->image->move(public_path('site/img/post'),$name);         
        }
        Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'image'=>$name,
            'category_id'=>$request->category_id,
            'user_id'=>auth()->user()->id
        ]);
        return response()->json([
            'success'=>'post added successfly'
           ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(
           [
            'post'=>Post::withCount('comments')->where('id',$id)
            ->with(['user','comments'])->get(),
           ]
         );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //  dd(('site/img/post/'.$post->image) );
        //  dd($request->hasFile('image') );
        $this->authorize('update',$post);

        $name=$post->image ? $post->image : null;
        if ($request->hasFile('image')){

               $ext=$request->image->getClientOriginalExtension();
               $name=time().'.'.$ext;
               $request->image->move(public_path('site/img/post'),$name);
               if ($post->image!=null && $post->image!='default.png') {
                unlink('site/img/post/'.$post->image);
             }         
        }
        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'image'=>$name,
            'category_id'=>$request->category_id,
            'user_id'=>$post->user_id
        ]);
        return response()->json([
             'success'=>'post updated successfly'
           ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('update',$post);
        $post->delete();
        return response()->json([
            'success'=>'post deleted successfly'
           ]);
    }

    public function force_delete( $id)
    { 
        $post=Post::onlyTrashed()->whereId($id)->first();
         $this->authorize('forceDelete',$post);
        $post->forceDelete();
        return response()->json([
            'success'=>'user '.$post->name.' restored successfly'
           ]);
    }

    public function restore( $id)
    {   
        $post=Post::onlyTrashed()->whereId($id)->first();
        // $this->authorize('restore',$post);
        $post->restore();
        return response()->json([
            'success'=>'user '.$post->name.' restored successfly'
           ]);
    }
}
