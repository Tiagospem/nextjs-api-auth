<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index() {
        return SubCategory::all();
    }
    public function store(Request $request) {
        try{
            $request->merge(['user_id'=>auth()->id()]);
            $fields = $request->only(['title', 'user_id', 'category_id']);
            $create = SubCategory::create($fields);
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
            $search = SubCategory::query()->findOrFail($id);
            $fields = $request->only(['title', 'hide', 'category_id']);
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
            $search = SubCategory::query()->findOrFail($id);
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
            $search = SubCategory::query()->findOrFail($id);
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
