<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function fixImage(Slider $slider)
    {
        if (Storage::disk('public')->exists($slider->image)) {
            $slider->image = Storage::url($slider->image);
        } else {
            $slider->image = 'images/no-ig.png';
        }
    }

    public function index()
    {
        $stt = 1;
        $slider = Slider::all();
        foreach ($slider as $s) {
            $this->fixImage($s);
        }
        return view('admin.slider.lst_slider', [
            'lst' => $slider,
            'stt' => $stt
        ]);
    }

    public function addSlider_get()
    {
        return view('admin.slider.add_slider');
    }

    public function addSlider_post(request $request)
    {
        $slider = new Slider();
        $slider->fill([
            'image' => "",
            'link' => $request->link
        ]);
        $slider->save();
        if ($request->hasFile('image')) {
            $slider->image = $request->file('image')->store('images/slider/' . $slider->id, 'public');
        }
        $slider->save();
        return redirect()->route('lst_slider');
    }
}
