<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(Request $request, $id)
    {

        if ($id != Auth::user()->id) {
            return back();
        }

        $profile = User::find($id);

      //  $exp_image = explode('http://localhost:8000/', $profile->image);

        $image = $profile->image;

        return view('profile.show', [
            'profile' => $profile,
            'image' => $image
        ]);
    }



    public function edit(Request $request, $id)
    {

        if ($id != Auth::user()->id) {
            return back();
        }

        $profile = User::find($id);

        //$exp_image = explode('http://localhost:8000/', $profile->image);

        $image = $profile->image;

        return view('profile.edit', [
            'profile' => $profile,
            'image' => $image,
        ]);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);



        $data = $request->except('password');

        if ($request->password && strlen($request->password) >= 8) {
            $password = Hash::make($request->password);
            $data['password'] = $password;
        }

        $user->update($data);

        if ($request->hasFile('image')) {
            $image = $request->image->store('images', 'public');
            $data['image'] = $image;
            $user->image = $data['image'];
            $user->save();
        }


        if ($request->org_name) {
            $user->organization->name = $request->org_name;
            $user->organization->save();;
        }
        if ($request->activity) {
            $user->organization->activity = $request->activity;
            $user->organization->save();;
        }





        session()->flash('success', ' تم تحديث الصفحة الشخصية بنجاح ');

        return redirect(route('admin.show.profile', Auth::user()->id));
    }
}
