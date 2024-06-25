<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function home_settings(){
        $services = Service::orderBy('id','desc')->get();
        return view('admin.settings.home-settings.index',compact('services'));
    }
    public function add(){
        return view('admin.settings.home-settings.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
        ]);

        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
        ]);
        return back()->with('message', ['text'=>'Service has been added!','type'=>'success']);
    }
    public function edit($id){
        $service = Service::find($id);
        return view('admin.settings.home-settings.edit',compact('service'));
    }
    public function update(Request $request, $id){
        $user = Service::find($id);
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
        ];
    
        $this->validate($request, $rules);
       
        $user->title = $request->input('title');
        $user->description = $request->input('description');
        $user->link = $request->input('link');
        $user->save();

        return back()->with('message', ['text'=>'Service has been updated!','type'=>'success']);
    }
    public function destroy($id){
        Service::where('id',$id)->delete();
        return back()->with('message', ['text'=>'Service has been deleted!','type'=>'success']);
    }
}
