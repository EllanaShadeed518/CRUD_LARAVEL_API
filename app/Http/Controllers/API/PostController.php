<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $posts=Post::all();
        return PostResource::collection($posts);//when return group of data
    }
    public function show($id){
       $post=Post::find($id);//not write fail when use api beacuse api not return to view
        if($post==null){
         return response()->json(['msg'=>'not found']);

}
return new PostResource($post);//when return one object create object from resourse not use collection

    }
    public function store(Request $request){


$validator=Validator::make($request->all(),[
    'title'=>'required',
    'description'=>'required',
    'image'=>'required',

]);
if($validator->fails()){
    return response()->json(['msg'=>$validator->errors()]);
}


        $fileName=Storage::putFile('posts',$request->image);
       $post= Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$fileName,
            'user_id'=>$request->id,
        ]);
        return response()->json(['msg'=>'data inserted succsesfully',
        'post'=>new PostResource($post),//return data to frontend use resource
        //'post'=>$post,//or return data without responce
    ]);
    }


    public function update(Request $request,$id){

        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required',
            'image'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['msg'=>$validator->errors()]);
        }


                $fileName=Storage::putFile('posts',$request->image);
                $post=Post::where('id','=',$id)->first();

               $post->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'image'=>$fileName,
                ]);
                return response()->json(['msg'=>'data updateed succsesfully',
                'post'=>new PostResource($post),//return data to frontend use resource
                //'post'=>$post,//or return data without responce
            ]);
            }

            public function delete($id){

                $post=POST::find($id);

                $post->delete();
                return response()->json(['msg'=>'data deleted sucsees','post'=>$post]);
            }



}   ?>
