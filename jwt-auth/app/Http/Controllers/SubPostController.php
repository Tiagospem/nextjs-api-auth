<?php

namespace App\Http\Controllers;

use App\SubPost;
use Illuminate\Http\Request;

class SubPostController extends Controller
{
    public function store(Request $request, $post_id) {
        try{
            $request->merge(['user_id'=>auth()->id()]);
            $request->merge(['post_id'=>$post_id]);
            $fields = $request->only(['title', 'text', 'user_id', 'post_id']);
            $create = SubPost::create($fields);
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
            $search = SubPost::query()->findOrFail($id);
            $fields = $request->only(['title', 'text']);
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
    public function destroy($id) {
        try{
            $search = SubPost::query()->findOrFail($id);
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
