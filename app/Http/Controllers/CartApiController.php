<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Color_prods;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CartApiController extends Controller
{

    public function fixImage(Cart $slider)
    {
        if (Storage::disk('public')->exists($slider->image)) {
            $slider->image = Storage::url($slider->image);
        } else {
            $slider->image = 'images/no-ig.png';
        }
    }

    public function index($id)
    {
        $stt = 1;
        $cart = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id', [$id]);
        foreach ($cart as $s) {
            if (Storage::disk('public')->exists($s->image)) {
                $s->image = Storage::url($s->image);
            } else {
                $s->image = 'images/no-ig.png';
            }
        }
        return response([
            'results' => $cart
        ]);
    }

    public function addCart(request $request)
    {
        // $cart = DB::select('select product_id from carts where product_id = ? and account_id = ?', [
        //     $request->product_id, $request->account_id
        // ]);
        $cart = Cart::where('account_id', $request->account_id)->where('product_id', $request->product_id)->get();
        $product = Color_prods::find($request->product_id);
        if ($cart != null || $cart != []) {
            foreach ($cart as $item) {
                if ($item->quantity < $product->stock) {
                    DB::update('update carts set quantity = quantity + 1 where product_id = ? and account_id = ?', [$request->product_id, $request->account_id]);
                    $count = Cart::where('account_id', '=', $request->account_id)->get();
                    return response([
                        'results' => 'sản phẩm đã thêm vào giỏ',
                        'count' => count($count)
                    ]);
                } else {
                    return response([
                        'results' => 'số lượng kho không đáp ứng nhu cầu của quý khách',
                    ]);
                }
            }
        }
        if ($product->stock <= 0) {
            return response([
                'results' => 'sản phẩm tạm hết hàng!',
            ]);
        } else {
            $cartitem = new Cart();
            $cartitem->fill([
                'quantity' => $request->quantity,
                'product_id' => $request->product_id,
                'account_id' => $request->account_id,
                'status' => $request->status
            ]);
            $cartitem->save();
            $count = Cart::where('account_id', '=', $request->account_id)->get();
            return response([
                'results' => 'sản phẩm đã thêm vào giỏ',
                'count' => count($count)
            ]);
        }
    }



    public function updateStatusCart(request $request)
    {
        $account_id = $request->account_id;
        DB::update('update carts set status = !status where account_id = ? and product_id = ?', [$request->account_id, $request->product_id]);
        // $cartitem->status = !$cartitem->status;
        // $cartitem->update();
        $cart = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id', [$request->account_id]);
        foreach ($cart as $s) {
            if (Storage::disk('public')->exists($s->image)) {
                $s->image = Storage::url($s->image);
            } else {
                $s->image = 'images/no-ig.png';
            }
        }
        return response([
            'results' => 'true',
            'lstCart' => $cart
        ]);
    }

    public function deleteCart(request $request)
    {

        Cart::where('account_id', $request->account_id)->where('product_id', $request->product_id)->delete();
        $cart = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id', [$request->account_id]);
        foreach ($cart as $s) {
            if (Storage::disk('public')->exists($s->image)) {
                $s->image = Storage::url($s->image);
            } else {
                $s->image = 'images/no-ig.png';
            }
        }
        return response([
            'results' => 'true',
            'lstCart' => $cart
        ]);
    }


    public function resetAllSatusCart(request $request)
    {
        $lstCart = Cart::where('account_id', $request->account_id)->get();
        foreach ($lstCart as $cart) {
            $cart->status = 0;
            $cart->update();
        }
        return response([
            'results' => 'true',
            'cc' => $lstCart
        ]);
    }


    public function updateQuantity(request $request)
    {
        $cartitem = Cart::where('account_id', $request->account_id)->where('product_id', $request->product_id)->get();
        $product = Color_prods::find($request->product_id);
        foreach ($cartitem as $cart) {
            if ($cart->quantity < $product->stock && $request->cal == 1) {
                $cart->quantity += 1;
                $cart->update();
                $carts = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id', [$request->account_id]);
                foreach ($carts as $s) {
                    if (Storage::disk('public')->exists($s->image)) {
                        $s->image = Storage::url($s->image);
                    } else {
                        $s->image = 'images/no-ig.png';
                    }
                }
                return response([
                    'success' => true,
                    'lstCart' => $carts
                ]);
            } else if ($cart->quantity > 1 && $request->cal == 0) {
                $cart->quantity -= 1;
                $cart->update();
                $carts = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id', [$request->account_id]);
                foreach ($carts as $s) {
                    if (Storage::disk('public')->exists($s->image)) {
                        $s->image = Storage::url($s->image);
                    } else {
                        $s->image = 'images/no-ig.png';
                    }
                }
                return response([
                    'success' => true,
                    'lstCart' => $carts
                ]);
            } else {
                $carts = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id', [$request->account_id]);
                foreach ($carts as $s) {
                    if (Storage::disk('public')->exists($s->image)) {
                        $s->image = Storage::url($s->image);
                    } else {
                        $s->image = 'images/no-ig.png';
                    }
                }
                return response([
                    'success' => false,
                    'lstCart' => $carts
                ]);
            }
        }
        // return response([
        //     'cc' => $cartitem
        // ]);
    }


    public function selectAll(request $request)
    {
        $lstCart = Cart::where('account_id', $request->account_id)->get();
        if ($request->check == 'false') {
            foreach ($lstCart as $cart) {
                $cart->status = 1;
                $cart->update();
            }
        } else if ($request->check == 'true') {
            foreach ($lstCart as $cart) {
                $cart->status = 0;
                $cart->update();
            }
        }
        Cart::where('account_id', $request->account_id)->where('product_id', $request->product_id)->delete();
        $cart = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id', [$request->account_id]);
        foreach ($cart as $s) {
            if (Storage::disk('public')->exists($s->image)) {
                $s->image = Storage::url($s->image);
            } else {
                $s->image = 'images/no-ig.png';
            }
        }
        return response([
            'results' => 'true',
            'lstCart' => $cart
        ]);
    }

    public function cart_checkout($id)
    {
        $sum = 0;
        $cart = DB::select('select carts.id,products.name,quantity,carts.product_id,account_id,color,image,price,sales_price,stock,carts.status  from carts,color_prods,products where account_id = ? and color_prods.id = carts.product_id and products.id = color_prods.product_id and carts.status = 1', [$id]);
        foreach ($cart as $s) {
            if (Storage::disk('public')->exists($s->image)) {
                $s->image = Storage::url($s->image);
            } else {
                $s->image = 'images/no-ig.png';
            }
            if ($s->sales_price > 0) {
                $sum += $s->sales_price * $s->quantity;
            } else {
                $sum += $s->price * $s->quantity;
            }
        }
        return response([
            'results' => $cart,
            'total_checkout' => $sum
        ]);
    }



    public function payCart(request $request)
    {
        $cartitem = DB::select('select * from color_prods,carts where color_prods.id = carts.product_id and carts.account_id = ? and carts.status = 1', [$request->account_id]);
        $orderitem = new Order();
        $year = date('Yy');
        $month = date('m');
        $day = date('d');
        $hour = date('h');
        $minute = date('i');
        $second = date('s');
        $orderId = $year + $month + $day + $hour + $minute + $second;
        $orderitem->fill([
            'id' => $orderId,
            'address' => $request->address,
            'date_create' => date('Y-m-d'),
            'phone' => $request->phone,
            'total' => $request->total,
            'status' => $request->status,
            'account_id' => $request->account_id
        ]);
        $orderitem->save();

        foreach ($cartitem as $c) {
            $item = new Order_details();
            $price = 0;
            if ($c->sales_price > 0) {
                $price = $c->sales_price;
            } else {
                $price = $c->price;
            }
            $item->fill([
                'price' => $price,
                'quantity' => $c->quantity,
                'product_id' => $c->product_id,
                'order_id' => $orderId
            ]);
            $item->save();
            Cart::where('account_id', $c->account_id)->where('product_id', $c->product_id)->delete();
        }
        return response([
            'results' => $cartitem,
            'time' => $orderId
        ]);
    }


    public function getOrder(request $request)
    {
        $lstOrder = DB::select('select orders.id,orders.address,orders.phone,total,orders.status,orders.account_id,fullname,date_create from orders,users where orders.account_id = users.id and orders.account_id = ? and orders.status = ?', [$request->account_id, $request->status]);
        return response([
            'results' => $lstOrder,
        ]);
    }


    public function cancelOrder(request $request)
    {
        // Order_details::where('order_id', $request->id)->delete();
        // Order::where('id', $request->id)->where('account_id', $request->account_id)->delete();
        // return response([
        //     'results' => true
        // ]);
        $order = Order::where('id', $request->id)->where('account_id', $request->account_id)->get();
        foreach ($order as $item) {
            $item->status = "đã huỷ";
            $item->update();
        }
        return response([
            'results' => true,
            'test' => $order
        ]);
    }
}
