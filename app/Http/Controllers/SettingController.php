<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings=Setting::first();
        return view('settings.settings',compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'=>['required','max:255'],
            'logo'=>['nullable'],
        ],[
            'site_name.required'=>'يرجى إدخال اسم الموقع',
        ]);
        $setting=Setting::findOrFail($request->id);
        $logo=$setting->logo;
        if($request->hasFile('image')){
            unlink('storage/'.$logo);
            $file_name=$request->file('image')->getClientOriginalName();
            $logo=$request->file('image')->storeAs('logo',$file_name,'public');
        }
        $request->merge([
            'logo'=> $logo
        ]);
        $setting->update($request->all());
        toastr()->success('تم تعديل الإعدادات بنجاح');
        return redirect()->back();
    }

}
