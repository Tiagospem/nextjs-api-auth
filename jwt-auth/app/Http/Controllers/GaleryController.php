<?php

namespace App\Http\Controllers;

use App\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index(){
        return Galery::all();
    }
    public function store(Request $request, $id, $sub_or_post) {
        try{
            $create = new Galery();
            $create->user_id = auth()->id();
            if($sub_or_post == 'post'){
                $create->post_id = $id;
            }else {
                $create->subpost_id = $id;
            }
            $create->img = 'xxx';
            $create->thumb = 'xxx';
            $create->region = 'xxx';
            $create->bucket = 'xxx';
            $create->path = 'xxx';
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

    public function destroy($id) {
        try{
            $search = Galery::query()->findOrFail($id);
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
