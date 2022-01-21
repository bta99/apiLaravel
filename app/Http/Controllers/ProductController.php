<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color_prods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    public function fixImage(Color_prods $product)
    {
        if (Storage::disk('public')->exists($product->image)) {
            $product->image = Storage::url($product->image);
        } else {
            $product->image = 'images/no-ig.png';
        }
    }


    public function index(request $request)
    {
        //
        if ($request->search_key != null) {
            $pro = Product::where('name', 'like', "%{$request->search_key}%")->orderBy('id', 'desc')->paginate(5);
            // dd($pro);
        } else if ($request->type_pro_key != null) {
            $pro = Product::where('category_id', '=', $request->type_pro_key)->orderBy('id', 'desc')->paginate(5);
        } else {
            $pro = Product::orderBy('id', 'desc')->paginate(5);
        }
        $stt = 1;
        $brand = Brand::all();
        $cate = Category::all();
        $color_prod = Color_prods::all();
        $total_stock = [];
        // for ($i = 0; $i < count($color_prod); $i++) { //
        //     $total_stock += $color_prod[$i]->stock;
        // }
        $count = 0;
        for ($i = 0; $i < count($pro); $i++) {
            $test = $pro[$i]->id;
            $count = DB::select('select sum(stock) as "sl" from color_prods where product_id = ?', [$test]);
            $total_stock[$i] = $count[0]->sl;
            if ($count[0]->sl == null || $count[0]->sl <= 0) {
                $total_stock[$i] = 0;
                $pro[$i]->status = "tạm hết hàng";
                $pro[$i]->save();
            } else {
                $pro[$i]->status = "còn hàng";
                $pro[$i]->save();
            }
        }
        return view('admin.product.product_home', [
            'lstPro' => $pro,
            'stt' => $stt,
            'brand' => $brand,
            'cate' => $cate,
            'stock' => $total_stock
        ]);
    }


    public function deletePro(request $request)
    {
        if ($request->id != null) {
            $pro  = Product::where('id', '=', $request->id)->get();
            $pro_Detail = Color_prods::where('product_id', $request->id)->get();
            foreach ($pro_Detail as $p) {
                $p->stock = 0;
                $p->save();
            }
            return Redirect(route('product_home'));
        }
        if ($request->id_active != null) {
            $pro  = Product::where('id', '=', $request->id_active)->get();
            $pro_Detail = Color_prods::where('product_id', $request->id_active)->get();
            foreach ($pro_Detail as $p) {
                $p->stock = 1;
                $p->save();
            }
            return redirect()->route('product_home');
        }
    }


    public function addPro_get()
    {
        $cate = Category::all();
        $brand = Brand::all();
        return view('admin.product.add_product', [
            'cate' => $cate,
            'brand' => $brand
        ]);
    }

    public function addPro_post(request $request, Product $product)
    {
        $request->validate([
            'name' => 'required||unique:products,name',
            'info' => 'required',
            'camera' => 'required',
            'pin' => 'required',
        ], [
            'name.required' => "Vui lòng nhập tên sản phẩm!",
            'name.unique' => "sản phẩm đã tồn tại!",
            'info.required' => "vui lòng nhập thông tin mô tả sản phẩm!",
            'camera.required' => "vui lòng nhập độ phân giải camera!",
            'pin.required' => "vui lòng nhập dung lượng pin!",
        ]);
        $status = "còn hàng";
        $condition = "đang kinh doanh";
        $product->fill([
            'name' => $request->name,
            'info' => $request->info,
            'ram' => $request->ram,
            'rom' => $request->rom,
            'camera' => $request->camera,
            'pin' => $request->pin,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => $status,
            'condition_product' => $condition
        ]);
        $product->save();
        return redirect()->route('product_home');
    }


    public function lstPro_detail()
    {
        $stt = 1;
        $lstPro_detail = Color_prods::all();
        $pro = Product::all();
        foreach ($lstPro_detail as $p) {
            $this->fixImage($p);
        }
        return view('admin.product.lst_product_detail', [
            'lst' => $lstPro_detail,
            'pro' => $pro,
            'stt' => $stt
        ]);
    }

    public function addPro_detail_get()
    {
        $pro = Product::all();
        return view('admin.product.add_product_detail', [
            'product' => $pro
        ]);
    }

    public function addPro_detail_post(request $request)
    {
        // dd($request->file('image'));
        $pro = new Color_prods();
        $pro->fill([
            'color' => $request->color,
            'price' => $request->price,
            'sales_price' => $request->sales_price,
            'stock' => $request->stock,
            'image' => "",
            'product_id' => $request->product_id
        ]);
        $pro->save();
        if ($request->hasFile('image')) {
            $pro->image = $request->file('image')->store('images/sp/' . $pro->id, 'public');
        }
        $pro->save();
        return redirect()->route('product_home');
    }

    public function deletePro_detail(request $request)
    {
        $pro = Color_prods::find($request->id);
        $pro->delete();
        return redirect()->route('lst-product-detail');
    }

    public function updatePro_get(Request $pro)
    {
        $cate = Category::all();
        $brand = Brand::all();
        $prod = Product::find($pro->id);
        return view('admin.product.update_product', [
            'cate' => $cate,
            'brand' => $brand,
            'prod' => $prod
        ]);
    }

    public function updatePro_post(Request $request)
    {
        $prod = Product::find($request->id);
        $prod->fill([
            'name' => $request->name,
            'info' => $request->info,
            'ram' => $request->ram,
            'rom' => $request->rom,
            'camera' => $request->camera,
            'pin' => $request->pin,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id
        ]);
        $prod->save();
        return redirect()->route('product_home');
    }


    public function updatePro_detail_get(request $request)
    {
        $pro_Detail = Color_prods::where('id', $request->id)->get();
        $proName = Product::where('id', $pro_Detail[0]->product_id)->get();
        // dd($pro_Detail);
        foreach ($pro_Detail as $p) {
            $this->fixImage($p);
        }
        return view('admin.product.update_pro_detail', [
            'product' => $pro_Detail[0],
            'name' => $proName[0]->name
        ]);
    }

    public function updatePro_detail_post(request $request)
    {
        $pro_Detail = Color_prods::where('id', $request->id)->get();
        if ($request->hasFile('image')) {
            $pro_Detail[0]->image = $request->file('image')->store('images/sp/' . $pro_Detail[0]->id, 'public');
        }
        $pro_Detail[0]->color = $request->color;
        $pro_Detail[0]->price = $request->price;
        $pro_Detail[0]->sales_price = $request->sales_price;
        $pro_Detail[0]->stock = $request->stock;
        $pro_Detail[0]->save();
        return redirect()->route('lst-product-detail');
    }
}
