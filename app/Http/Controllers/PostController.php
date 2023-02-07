<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::paginate(1);
       //$posts=Post::all();

return view('index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $posts =$request->validate([
            'title' =>'required',
            'description' => 'required',
           'image' => 'required|image|mimes:png,jpg,gif',
        ]);

    $filename=Storage::putFile("posts",$posts['image']);//هذا السطر بخزن الصورة نفسها داخل ملف اسمه بوستس هوي بعمله داخل الستورج وبشفر الصورة وبحط امتداه
    //dd( $filename);
    $posts['image']=$filename;//اخلي الاسم بالداتا بيس هوي الاسم الجديد للصورة بعد التشفير
    //dd($request->all());
        Post::create($posts);
        return redirect()->route('posts.index')->with(['status' => true , "message" => 'post created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts.index')->with(['status' => true , "message" => 'post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with(['status' => true , "message" => 'post deleted successfully']);
    }
}
