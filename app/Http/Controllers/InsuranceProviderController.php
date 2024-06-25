<?php

namespace App\Http\Controllers;

use App\User;
use App\InsuranceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InsuranceProviderController extends Controller
{
    public function index(){
        $users = InsuranceProvider::orderBy('id','desc')->get();
        return view('admin.insurance-provider.index',compact('users'));
    }
    public function add(){
        return view('admin.insurance-provider.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required'
        ]);

        if($request->image != null){
            $profileImage = time().'.'.$request->image->extension();
            $request->image->move(public_path('media/images'), $profileImage);
            $profile = 'media/images/'.$profileImage;
        } else {
            $profile = '';
        }
        
        $user = InsuranceProvider::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cname' => $request->cname,
            'address' => $request->address,
            'image' => $profile
        ]);
        
        return back()->with('message', ['text'=>'User has been added!','type'=>'success']);
    }
    public function edit($id){
        $user = InsuranceProvider::find($id);
        return view('admin.insurance-provider.edit',compact('user'));
    }
    public function update(Request $request, $id){
        $user = InsuranceProvider::find($id);
        $rules = [
            'name' => 'required',
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
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->cname = $request->input('cname');
        $user->address = $request->input('address');
        $user->save();

        return back()->with('message', ['text'=>'User has been updated!','type'=>'success']);
    }
    public function destroy($id){
        InsuranceProvider::where('id',$id)->delete();
        return back()->with('message', ['text'=>'User has been deleted!','type'=>'success']);
    }
}
