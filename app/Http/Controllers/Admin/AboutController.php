<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class AboutController extends Controller
{
    public function about()
    {
        $me = About::first();
        return view('admin.settings.about', compact('me'));
    }

    public function aboutSave($id = null, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $about = About::find($id);
        if (!$about) {
            $about = new About();
        }
        $about->name = $request->name;
        $about->description = $request->description;
        $about->user_id = auth()->id();
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $slug = Str::slug($request->name);

            if (isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-me-' . Auth::id() . '-' . $currentDate . '.' . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('users')) {
                    Storage::disk('public')->makeDirectory('users');
                }
                if (Storage::disk('public')->exists('users/' . $about->image??$request->image) && $about->image??$request->image != 'default.png') {
                    Storage::disk('public')->delete('users/' . $about->image??$request->image);
                }
                $userimage = Image::make($image)->stream();
                Storage::disk('public')->put('users/' . $imagename, $userimage);

            } else {
                $imagename = $about->image;
            }

        }

        $about->image = $imagename;
        $about->save();
        Toastr::success('message', 'About me updated successfully.');
        return back();

    }

}
