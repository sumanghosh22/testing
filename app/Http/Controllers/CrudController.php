<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;


class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //

        return redirect()->to('register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //echo 'its here';die();
        $data = $request->all();
        //dd($input);
       // $data['name'] ='';

       $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
           //$this->index();
           //echo 'faild';exit();
          // return redirect()->to('register'); 
            //return view('Auth.register'); 
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();

        } else {
            
        

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Session::flash('message', 'User created successfully!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->to('home');
        }
       // echo 'created successfully';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
       // echo $id;exit();
       $userDetails = User::find($id);
      // dd($userDeatails->name);
      return view('Auth.edit_user',compact('userDetails')); 


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        //dd($user);    
        $user->save();
        Session::flash('message', 'User update successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->to('home');
             
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
        User::destroy($id);
        Session::flash('message', 'User deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->to('home');


    }
}
