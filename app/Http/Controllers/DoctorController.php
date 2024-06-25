<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index(){
        $users = Doctor::orderBy('id','desc')->get();
        return view('admin.doctor.index',compact('users'));
    }
    public function add(){
        return view('admin.doctor.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'designation' => 'required',
            'biography' => 'required',
            'image' => 'required'
        ]);
        
        if($request->image != null){
            $profileImage = time().'.'.$request->image->extension();
            $request->image->move(public_path('media/images'), $profileImage);
            $profile = 'media/images/'.$profileImage;
        } else {
            $profile = '';
        }

        Doctor::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'biography' => 'biography',
            'image' => $profile
        ]);
        return back()->with('message', ['text'=>'Doctor has been added!','type'=>'success']);
    }
    public function edit($id){
        $user = Doctor::find($id);
        return view('admin.doctor.edit',compact('user'));
    }
    public function update(Request $request, $id){
        $user = Doctor::find($id);
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'biography' => 'required'
        ];
    
        $this->validate($request, $rules);
        if($request->image != null){
            $profileImage = time().'.'.$request->image->extension();
            $request->image->move(public_path('media/images'), $profileImage);
            $user->image = 'media/images/'.$profileImage;
        } else {
            unset($user->image);
        }
        $user->name = $request->input('name');
        $user->designation = $request->input('designation');
        $user->biography = $request->input('biography');
        $user->save();

        return back()->with('message', ['text'=>'Doctor has been updated!','type'=>'success']);
    }
    public function destroy($id){
        Doctor::where('id',$id)->delete();
        return back()->with('message', ['text'=>'Doctor has been deleted!','type'=>'success']);
    }
    public function all_appointments(){
        $appointments = Appointment::orderBy('id','desc')->get();
        return view('admin.all-appointments',compact('appointments'));
    }
}