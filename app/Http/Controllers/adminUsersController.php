<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserRequest;
use App\Http\Requests\editUserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class adminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createUserRequest $request)
    {


        if ($request->hasFile('path')){
            $file = $request->file('path')->getClientOriginalName();
            $name =time(). $file ;
            $request->file('path')->move('admin/images',$name);


           $photo = Photo::create(['path'=>$name]);

            $photo_id = $photo->id;

        }else{

            $photo_id = null;
        }

        $pass = bcrypt($request->password);

         User::create(['name'=>$request->name,
             'password'=>$pass,
             'email'=>$request->email,
             'role_id'=>$request->role_id,
             'is_active'=>$request->is_active,
             'photo_id'=>$photo_id
         ]);

        return redirect('/admin/users');


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

        $user = User::findOrFail($id);

        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editUserRequest $request, $id)
    {


        //


        if($request->password == ''){
            $inputs = $request->except('password');
        }else{
            $inputs = $request->all();
            $inputs['pssword'] = bcrypt($request->password);
        }

        if($request->hasFile('path')){
            $file = $request->file('path')->getClientOriginalName();
            $name = time().$file;
            $request->file('path')->move('admin/images',$name);
            $photo = Photo::create(['path'=>$name]);
             $photo_id = $photo->id;
        }else{
           $userphotoid = User::findOrFail($id);
            $photo_id = $userphotoid->photo_id;
    }
        $inputs['photo_id'] = $photo_id;

         $user = User::findOrFail($id);
         $user->update($inputs);

        return redirect(route('users.index'));

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
    }

}
