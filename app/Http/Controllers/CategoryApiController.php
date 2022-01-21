<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryApiController extends Controller
{

    public function fixImage(Category $slider)
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
        $cate = Category::all();
        foreach ($cate as $s) {
            $this->fixImage($s);
        }
        return response([
            'results' => $cate
        ]);
    }
}
