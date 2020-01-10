<?php

namespace App\Http\Controllers;

use App\Http\Requests\postsRequest;
use App\Photo;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = post::all();

        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(postsRequest $request)
    {
        //

        $inputs = $request->all();

        if($request->hasFile('path')){
            $file = $request->file('path')->getClientOriginalName();
            $name = time() . $file;
            $request->file('path')->move('admin/images',$name);
            $photo = Photo::create(['path'=>$name]);
            $photo_id = $photo->id;
        }else{
            $photo_id = null;
        }

        $inputs['photo_id'] = $photo_id;

        $userid = Auth::id();

        $inputs['user_id'] = $userid;



        post::create($inputs);

        session()->flash('createdpost','post has been created');

        return redirect(route('posts.index'));

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
    public function edit($id)
    {
        //

        $post = post::FindOrFail($id);
        return view('admin.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(postsRequest $request, $id)
    {
        //
        $inputs = $request->all();
        $post = post::FindOrFail($id);
        if ($request->hasFile('path')){
            $file = $request->file('path')->getClientOriginalName();
            $name = time() . $file;
            $request->file('path')->move('admin/images',$name);
            if ($post->photo_id !== null){
                unlink(public_path() . $post->photo->path);
                $post->photo->delete();
            }
            $photo = photo::create(['path'=>$name]);
            $photo_id  = $photo->id;
            $inputs['photo_id'] = $photo_id;
        }

        $post->update($inputs);
        session()->flash('updatepost','post has beeen updated ya prince');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = post::FindOrFail($id);
        unlink(public_path().$post->photo->path);
        $post->photo()->delete();
        session()->flash('deletepost','post has ben deleted');
        $post->delete();

        return redirect(route('posts.index'));

    }
}
