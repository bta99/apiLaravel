<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderApiController extends Controller
{

    public function fixImage($item)
    {
        if (Storage::disk('public')->exists($item->image)) {
            $item->image = Storage::url($item->image);
        } else {
            $item->image = 'images/no-ig.png';
        }
    }

    public function index()
    {
        //danh sach san pham
        $lstColor = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id order by id desc');
        foreach ($lstColor as $item) {
            $this->fixImage($item);
        }
        //danh sach san pham sales
        $lstSales = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and sales_price > 0 order by id desc');
        foreach ($lstSales as $item) {
            $this->fixImage($item);
        }
        //danh sach slider
        $slider = Slider::all();
        foreach ($slider as $item) {
            $this->fixImage($item);
        }
        //danh sach category
        $cate = Category::all();
        foreach ($cate as $item) {
            $this->fixImage($item);
        }
        return response([
            'lstSlider' => $slider,
            'lstCate' => $cate,
            'lstProduct' => $lstColor,
            'lstSales' => $lstSales,
        ]);
    }
}
