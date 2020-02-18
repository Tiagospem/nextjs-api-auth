<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return Post::all();
    }
    public function store(Request $request) {
        try{
            $request->merge(['user_id'=>auth()->id()]);
            $fields = $request->only(['title', 'text', 'user_id', 'subcategory_id']);
            $create = Post::create($fields);
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
    public function update(Request $request, $id) {
        try{
            $search = Post::query()->findOrFail($id);
            $fields = $request->only(['title', 'text', 'subcategory_id']);
            $search->fill($fields)->save();

            return [
                'status'=>true,
                'reg'=>$search
            ];
        }catch (\Exception $exception){
            return [
                'status'=>false,
                'error'=>$exception->getMessage()
            ];
        }
    }
    public function show($id) {
        try{
            $search = Post::query()
                ->findOrFail($id)
                ->with([
                    'replies',
                    'movies',
                    'files',
                    'galeries',
                    'subpost'=> function ($query){
                        $query->with([
                            'galeries',
                            'files',
                            'movies'
                        ]);
                    }
                ])
                ->first();
            return [
                'status'=>true,
                'reg'=>$search
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
            $search = Post::query()->findOrFail($id);
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
