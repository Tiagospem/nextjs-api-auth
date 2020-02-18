<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return Category::all();
    }
    public function store(Request $request) {
        $request->merge(['user_id'=>auth()->id()]);
        $fields = $request->only(['title', 'user_id']);
        $create = Category::create($fields);
        return [
            'status'=>true,
            'reg'=>$create
        ];
    }
    public function update(Request $request, $id) {
        try{
            $search = Category::query()->findOrFail($id);
            $request->merge(['user_id'=>auth()->id()]);
            $fields = $request->only(['title', 'user_id', 'hide']);
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
            $search = Category::query()->findOrFail($id);
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
            $search = Category::query()->findOrFail($id);
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
