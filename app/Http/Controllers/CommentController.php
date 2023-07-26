<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCommentsAndUsersOfPost($postId)
    {
        return response()->json([
           'comments'=>Comment::where('post_id',$postId)->with('user')->orderBy('created_at','desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request,User $user)
    {
        // dd('hhhhhhhhhhhh');
        $this->authorize('login',$user);

         Comment::create([
          'content'=> $request->content,
          'post_id'=> $request->post_id,
          'user_id'=> $request->user_id
        ]);
        return response()->json([
         'success'=>'comment added successfly'
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
