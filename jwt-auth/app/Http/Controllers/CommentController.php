<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public  function index($post_id){
        return Comment::query()->where('post_id', $post_id)->get();
    }
    public function store(Request $request, $post_id) {
        try{
            $request->merge(['user_id'=>auth()->id()]);
            $request->merge(['post_id'=>$post_id]);
            $fields = $request->only(['text', 'user_id', 'post_id']);
            $create = Comment::create($fields);
            return [
                'status'=>true,
                'reg'=>$create
            ];
        }catch (\Exception $exception){
            return [
                'status'=>false,
                'error'=>$exception->getMessage()
            ];
        }
    }

    public function destroy($id) {
        try{
            $search = Comment::query()->findOrFail($id);
            $search->delete();
            return [
                'status'=>true,
            ];
        }catch (\Exception $exception){
            return [
                'status'=>false,
                'error'=>$exception->getMessage()
            ];
        }
    }
}
