<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function key_settings(){
        $setting = Setting::first();
        return view('admin.settings.key-settings',compact('setting'));
    }
    public function update_settings(Request $request){
        $data = $request->all();
        unset($data['_token']);
      
        $update = Setting::first();
        $update->fill($data)->save();
        return back()->with('message', ['text'=>'Setting has been updated successfully.','type'=>'success']);
    }
}
