<?php

namespace App\Http\Controllers;

use App\YoutubeUrl;
use Illuminate\Http\Request;

class YoutubeUrlController extends Controller
{
    public function index() {
        return YoutubeUrl::all();
    }
    public function store(Request $request, $id, $sub_or_post) {
        try{
            $create = new YoutubeUrl();
            $create->user_id = auth()->id();
            if($sub_or_post == 'post'){
                $create->post_id = $id;
            }else {
                $create->subpost_id = $id;
            }
            $create->title = $request->title;
            $create->url = $request->url;
            $create->save();

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
            $search = YoutubeUrl::query()->findOrFail($id);
            $fields = $request->only(['title', 'url']);
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
            $search = YoutubeUrl::query()->findOrFail($id);
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
