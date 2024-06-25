<?php

namespace App\Http\Controllers;

use App\Patient;
use App\User;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index(){
        $users = Patient::whereRole('patient')->orderBy('id','desc')->get();
        return view('admin.patient.index',compact('users'));
    }
    public function add(){
        return view('admin.patient.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required'
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'patient',
            'password' => Hash::make($request->password),
        ]);
        return back()->with('message', ['text'=>'User has been added!','type'=>'success']);
    }
    public function edit($id){
        $user = Patient::find($id);
        return view('admin.patient.edit',compact('user'));
    }
    public function update(Request $request, $id){
        $user = Patient::find($id);
        $rules = [
            'name' => 'required|string|max:255',
        ];
    
        if ($user->email !== $request->input('email')) {
            $rules['email'] = 'required|email|unique:users|max:255';
        }
    
        $this->validate($request, $rules);
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return back()->with('message', ['text'=>'User has been updated!','type'=>'success']);
    }
    public function destroy($id){
        Patient::where('id',$id)->delete();
        return back()->with('message', ['text'=>'User has been deleted!','type'=>'success']);
    }
}
