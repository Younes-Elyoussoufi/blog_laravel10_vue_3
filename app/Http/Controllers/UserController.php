<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
         $this->authorize('delete', $user);
         $pagination=10 ;
        return response()->json([
            'users'=>User::paginate($pagination),
            'pages_count'=>ceil(count(Post::all()) / $pagination),
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
    public function store(Request $request)
    {
        //
    }

    public function users_archive(User $user)
    {
        $this->authorize('delete',$user);
        return response()->json([
            'users'=>User::onlyTrashed()->get(),
         ]);

    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
         $this->authorize('create',$user);
        return response()->json([
            'user'=>$user
           ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       $this->authorize('update',$user);

        $name='default.jpg';
        if ($request->hasFile('avatar')){
            // !file_exists(public_path().'/site/img/user/'.
               $ext=$request->avatar->getClientOriginalExtension();
               $name=time().'.'.$ext;
               $request->avatar->move(public_path('site/img/user/'),$name);
               if ($user->avatar !='default.jpg') {
                unlink(public_path('site/img/user/').$user->avatar);
             }         
        }
        if (!$request->hasFile('avatar')){
               if ($user->avatar !='default.jpg') {
                $name=$user->avatar;
             }         
        }
        $user->update([
            'name'=>$request->name,
            'about'=>$request->about,
            'avatar'=>$name,
            'country'=>$request->country,
        ]);
        return response()->json([
             'success'=>'user updated successfly',
           //  'user'=>$user
           ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);
        $user->delete();
        return response()->json([
            'success'=>'user '.$user->name.' deleted successfly'
           ]);
          
    }

    public function restore( $id,User $user)
     {   
        $this->authorize('delete',$user);
        $user=User::onlyTrashed()->whereId($id)->first();
        $user->restore();
        return response()->json([
            'success'=>'user '.$user->name.' restored successfly'
           ]);
    }
    public function force_delete( $id,User $user)
    { 
        $this->authorize('forceDelete',$user);
        $user=User::onlyTrashed()->whereId($id)->first();
        $user->forceDelete();
        return response()->json([
            'success'=>'user '.$user->name.' deleted definitively'
           ]);
    }
    // ========== auth ===================================================

    
}
