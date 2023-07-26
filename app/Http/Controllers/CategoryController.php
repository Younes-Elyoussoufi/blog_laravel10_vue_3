<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
   public function addCategory(StoreCategoryRequest $request,User $user){
        $this->authorize('delete',$user,'cat lissst');
       
        Category::create([
          'name'=>$request->name
        ]);
       
        return response()->json([
            'success'=>'Category added successfly'
        ]);
    }

    public function deleteCategory($id,User $user)
    {   
        $this->authorize('delete',$user);

        $category=Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'success'=>'category deleted successfuly'
           ]);
    }
}
