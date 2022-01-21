<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $lstCate = Category::all();
        foreach ($lstCate as $s) {
            $this->fixImage($s);
        }
        return view('admin.category.lstcategories', [
            'lst' => $lstCate,
            'stt' => $stt
        ]);
    }

    public function addCategory_get()
    {
        return view('admin.category.add_cate');
    }

    public function addCategory_post(request $request)
    {
        $cate = new Category();
        $cate->fill([
            'image' => "",
            'type_prod' => $request->type_prod
        ]);
        $cate->save();
        if ($request->hasFile('image')) {
            $cate->image = $request->file('image')->store('images/category/' . $cate->id, 'public');
        }
        $cate->save();
        return redirect()->route('lst_category');
    }
}
