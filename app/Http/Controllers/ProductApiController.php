<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Color_prods;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{

    public function fixImage($cl)
    {
        if (Storage::disk('public')->exists($cl->image)) {
            $cl->image = Storage::url($cl->image);
        } else {
            $cl->image = 'images/no-ig.png';
        }
    }

    public function index()
    {
        $stt = 1;
        $lstColor = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id order by id desc');
        foreach ($lstColor as $lst) {
            $this->fixImage($lst);
            // $lst->price = number_format($lst->price);
        }
        return response([
            'lstColor' => $lstColor
        ]);
    }

    public function getProId(request $request)
    {
        $lstColor = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and products.id = ?', [$request->id]);


        $check = false;
        $checkinWishlist = false;
        $lstCM = DB::select('select comments.id,content,rating,account_id,product_id,users.image,users.fullname from comments,users where product_id = ? and comments.account_id = users.id order by id desc', [$request->id]);
        $lstCM2 = DB::select('select color_prods.product_id from orders,order_details,color_prods where orders.id = order_details.order_id and orders.account_id = ? and orders.status = "đã nhận" and order_details.product_id = color_prods.id', [$request->account_id]);
        foreach ($lstCM2 as $c) {
            if ($c->product_id == $request->id) {
                $check = true;
            }
        }

        $item = WishList::where('account_id', $request->account_id)->where('product_id', $request->product_id)->get();
        if (count($item) <= 0) {
            $checkinWishlist = false;
        } else {
            $checkinWishlist = true;
        }

        if ($lstColor != []) {
            foreach ($lstColor as $lst) {
                $this->fixImage($lst);
            }
            return response([
                'lstColor' => $lstColor,
                'lstCM' => $lstCM,
                'check' => $check,
                'check2' => $checkinWishlist
            ]);
        } else {
            return response([
                'lstColor' => 'faild'
            ]);
        }
    }

    public function search(request $request)
    {
        if ($request->categoryid == null || $request->categoryid == "" || $request->categoryid == 0) {
            $pro = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id');
        } else if ($request->cal == "increase") {
            $pro = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and products.category_id = ? order by price', [$request->categoryid]);
        } else if ($request->cal == "diminish") {
            $pro = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and products.category_id = ? order by price desc', [$request->categoryid]);
        } else if ($request->cal == "sales") {
            $pro = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and color_prods.sales_price > 0 and products.category_id = ?', [$request->categoryid]);
        } else {
            $pro = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and products.category_id = ?', [$request->categoryid]);
        }
        foreach ($pro as $p) {
            $this->fixImage($p);
        }
        return response([
            'lstpro' => $pro
        ]);
    }

    public function search2(request $request)
    {
        if ($request->name == null || $request->name == "") {
            $pro = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id');
        } else {
            $pro = DB::select("select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and products.name like '%$request->name%'");
        }
        foreach ($pro as $p) {
            $this->fixImage($p);
        }
        return response([
            'lstpro' => $pro
        ]);
    }

    public function upload(request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        Storage::put('public/images/avatar/' . $user->id . '/' . $user->id . '.' . 'jpg', base64_decode($request->cc));
        $user->image = 'storage/images/avatar/' . $id . '/' . $id . '.jpg';
        $user->update();
        if ($user->image != "" || $user->image != null) {
            return response([
                'check' => true,
            ]);
        } else {
            return response([
                'check' => false,
            ]);
        }
        // if ($request->cc != null || $request->cc != "") {
        //     $user->image = 'img';
        // }


        // $pro = new Color_prods();
        // $pro->fill([
        //     'color' => 'red',
        //     'price' => 1500,
        //     'sales_price' => 1400,
        //     'stock' => 15,
        //     'image' => "",
        //     'product_id' => 4
        // ]);
        // $pro->save();

        // if ($request->cc != "" || $request->cc != null) {
        //     $imageName = $pro->id . '.' . 'jpg';
        //     Storage::disk('public')->put($imageName, base64_decode($request->cc));
        //     $pro->image = $pro->id . '.' . 'jpg';
        //     $pro->save();
        //
        // }

        // Storage::put('public/images/sp/' . $pro->id . '/' . $pro->id . '.' . 'jpg', base64_decode($request->cc));

        // if ($request->hasFile('cc')) {
        //     $pro->image = $request->file(base64_decode(($request->cc)))->store('images/sp/' . $pro->id, 'public');
        // }
        // $pro->save();
        // return response([
        //     'check' => true,
        // ]);
    }


    public function getProduct_sale()
    {
        $lstColor = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and sales_price > 0 order by id desc');
        foreach ($lstColor as $lst) {
            $this->fixImage($lst);
        }
        return response([
            'lstColor' => $lstColor
        ]);
    }


    public function getOne($id)
    {
        $product = DB::select('select color_prods.id,name,info,ram,rom,pin,camera,color,image,price,sales_price,stock,product_id from products,color_prods where products.id = color_prods.product_id and color_prods.id = ?', [$id]);
        foreach ($product as $lst) {
            $this->fixImage($lst);
        }
        return response([
            'results' => $product
        ]);
    }



    // public function getComment(request $request)
    // {
    //     $check = false;
    //     $lstCM = DB::select('select comments.id,content,rating,account_id,product_id,users.image,users.fullname from comments,users where product_id = ? and comments.account_id = users.id order by id desc', [$request->product_id]);
    //     $lstCM2 = DB::select('select color_prods.product_id from orders,order_details,color_prods where orders.id = order_details.order_id and orders.account_id = ? and orders.status = "đã nhận" and order_details.product_id = color_prods.id', [$request->account_id]);
    //     foreach ($lstCM2 as $c) {
    //         if ($c->product_id == $request->product_id) {
    //             $check = true;
    //         }
    //     }
    //     return response([
    //         'results' => $lstCM,
    //         'check' => $check,
    //         // 'avarageRating' => ceil($avarageRating / count($lstCM))
    //     ]);
    // }

    public function addComment(request $request)
    {
        $newComment = new Comment();
        $newComment->fill([
            'content' => $request->content,
            'rating' => $request->rating,
            'account_id' => $request->account_id,
            'product_id' => $request->product_id
        ]);
        $newComment->save();
        $lstCM = DB::select('select comments.id,content,rating,account_id,product_id,users.image,users.fullname from comments,users where product_id = ? and comments.account_id = users.id order by id desc', [$request->product_id]);

        return response([
            // 'add' => true,
            'lstCM' => $lstCM,

        ]);
    }



    public function getWishList($accountid)
    {
        $wishList = DB::select('select wishlist.id,products.name,color,color_prods.image,price,sales_price,wishlist.account_id,wishlist.product_id from wishlist,products,color_prods where account_id = ? and wishlist.product_id = color_prods.id and color_prods.product_id = products.id', [$accountid]);
        foreach ($wishList as $lst) {
            $this->fixImage($lst);
        }
        return response([
            'results' => $wishList
        ]);
    }


    public function add_WishList(request $request)
    {
        $checkinWishlist = false;
        $item = WishList::where('account_id', $request->account_id)->where('product_id', $request->product_id)->get();
        if (count($item) <= 0) {
            $wishItem = new WishList();
            $wishItem->fill([
                'account_id' => $request->account_id,
                'product_id' => $request->product_id
            ]);
            $wishItem->save();
            $checkinWishlist = true;
        } else {
            WishList::where('account_id', $request->account_id)->where('product_id', $request->product_id)->delete();
            $checkinWishlist = false;
        }
        $wishList = DB::select('select wishlist.id,products.name,color,color_prods.image,price,sales_price,wishlist.account_id,wishlist.product_id from wishlist,products,color_prods where account_id = ? and wishlist.product_id = color_prods.id and color_prods.product_id = products.id', [$request->account_id]);
        foreach ($wishList as $lst) {
            $this->fixImage($lst);
        }
        return response([
            'success' => true,
            'check' => $checkinWishlist,
            'lstWL' => $wishList
        ]);
    }

    public function check_Wishlist(request $request)
    {
        $item = WishList::where('account_id', $request->account_id)->where('product_id', $request->product_id)->get();
        if (count($item) <= 0) {
            return response([
                'check' => false,
                'item' => count($item)
            ]);
        } else {
            return response([
                'check' => true,
                'item' => count($item)
            ]);
        }
    }
}
