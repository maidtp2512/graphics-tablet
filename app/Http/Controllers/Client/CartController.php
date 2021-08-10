<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Detail_Bill;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $categories = new Category();
        $cate = $categories->all(array('name', 'id'));
        return view('client/cart/cart', [
            'categories' => $cate
        ]);
    }

    public function addToCart($id)
    {
        if(!empty(Auth::user())){
            $all = Cart::where('id_user', '=', Auth::user()->id)->get();
            $quantity = 1;
            $new = 0;
            if(count($all) == 0){
                Cart::create(array('id_product'=>$id, 'quantity'=>$quantity, 'id_user'=>Auth::user()->id));
            } else{
                foreach ($all as $item){
                    if($item->id_product == $id){
                        $item->quantity = $item->quantity + 1;
                        $item->save();
                        $new = 1;
                    }
                }
                if($new == 0){
                    Cart::create(array('id_product'=>$id, 'quantity'=>$quantity, 'id_user'=>Auth::user()->id));
                }
            }
        }
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('status', 'Thêm sản phẩm vào giỏ hàng thành công!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            if(!empty(Auth::user())){
                $all = Cart::where('id_user', '=', Auth::user()->id)->get();
                foreach ($all as $item){
                    if($item->id_product == $request->id){
                        $item->quantity = $cart[$request->id]["quantity"];
                        $item->save();
                    }
                }
            }
            session()->put('cart', $cart);
            session()->flash('status', 'Cập nhật giỏ hàng thành công!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            if(!empty(Auth::user())){
                $all = Cart::where('id_user', '=', Auth::user()->id)->get();
                foreach ($all as $item){
                    if($item->id_product == $request->id){
                        $cart = new Cart();
                        $cart->withTrashed()->where('id_product', $request->id)->forceDelete();
                    }
                }
            }
            session()->flash('status', 'Xóa sản phẩm thành công!');
        }
    }

    public function checkout()
    {
        $categories = new Category();
        $cate = $categories->all(array('name', 'id'));
        return view('client/cart/checkout', [
            'categories' => $cate
        ]);
    }
    public function addWishlist($id)
    {
        $all = Wishlist::where('id_user', '=', Auth::user()->id)->get();
        foreach ($all as $item){
            if($item->id_product == $id){
                return redirect()->back()->with('status',"Sản phẩm đã có trong wishlist của bạn!");
            }else{
                session()->put('countW', session('countW') + 1);
                Wishlist::create(array('id_product'=>$id, 'id_user'=>Auth::user()->id));
                return redirect()->back()->with('status',"Thêm sản phẩm vào wishlist thành công!");
            }
        }
    }
    public function wishlist(){
        $categories = new Category();
        $cate = $categories->all(array('name', 'id'));
        $list = Wishlist::where('id_user', '=', Auth::user()->id)->get();
        $wishlist = [];
        foreach ($list as $item){
            $wishlist[$item->id] = Product::find($item->id_product);
        }
        return view('client/wishlist', [
            'categories' => $cate,
            'wishlist'=>$wishlist
        ]);
    }
    public function wishlistRemove($id){
        session()->put('countW', session('countW') - 1);
        $wishlist = new Wishlist();
        $wishlist->withTrashed()->where('id', '=', $id)->forceDelete();
        return redirect()->back()->with('status',"Xóa sản phẩm trong wishlist thành công!");
    }
    public function payment(Request $request){
        $order = session()->get('order', []);
        $order = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            "address" => $request->input('address'),
            "note" => $request->input('note'),
            "count" => $request->input('count'),
            "total" => $request->input('total'),
        ];
        session()->put('order', $order);

        if($request->input('order') == 1){
            $order = session()->get('order');
            $name = $order['name'];
            $email = $order['email'];
            $phone = $order['phone'];
            $address = $order['address'];
            $note = $order['note'];
            $count = $order['count'];
            $payment_status = 'Chưa thanh toán';
            $delivery_status = 'Chưa giao hàng';
            $price_to_pay = $order['total'];
            $bill = new Bill();
            $max_bill = $bill->max('id');
            $id_order = 'DH'.date("Y").($max_bill+1);
            $bill_ID =
                Bill::create(array(
                        'id_order'=>$id_order,
                        'name'=>$name,
                        'email'=>$email,
                        'phone'=>$phone,
                        'address'=>$address,
                        'note'=>$note,
                        'count'=>$count,
                        'total'=>$price_to_pay,
                        'payment_status'=>$payment_status,
                        'delivery_status'=>$delivery_status,
                    )
                );

            // var_dump($insert_bill);
            if ($bill_ID) {
                $cart = session()->get('cart', []);
                $detail_bill = new Detail_Bill();

                foreach ($cart as $item) {
                    Detail_Bill::create(array(
                            'name' => $item['name'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'image' => $item['image'],
                            'id_order' => $id_order
                        )
                    );
                }
                foreach (session()->get('cart') as $key => $item) {
                    unset($cart[$key]);
                    session()->put('cart', $cart);
                }
                $categories = new Category();
                $data = $categories->all(array('name', 'id'));
                $data_detail_bill = Detail_Bill::where('id_order', '=', $id_order)->get();
                $data_bill = Bill::where('id_order', '=', $id_order)->get();
                return view('/client/cart/result', [
                    'detail_bill' => $data_detail_bill,
                    'bill' => $data_bill,
                    'categories' => $data,
                    'message' => 'Đặt hàng toán thành công!'
                ]);
            }
        }else{

            $total_price = $request->input('total');
            $price_to_pay = $total_price * 100;
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

            // config.php
            $vnp_TmnCode = "ZVYN925E"; //Mã website tại VNPAY
            $vnp_HashSecret = "TJAPLVJKGQGEAKISHNHFBREVGCWMLWCW"; //Chuỗi bí mật
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/return";


            // end config.php

            $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán đơn hàng';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $price_to_pay * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];


            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            // var_dump($vnp_Url);
            return redirect($vnp_Url);
        }

    }
    public function return(){
        $order = session()->get('order');
        $name = $order['name'];
        $email = $order['email'];
        $phone = $order['phone'];
        $address = $order['address'];
        $note = $order['note'];
        $count = $order['count'];
        $payment_status = 'Đã thanh toán';
        $delivery_status = 'Chưa giao hàng';
        $price_to_pay = $order['total'];
        $discount_price = 0;
        $payments = 'online';
        $status = 'pending';
        $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
        if ($vnp_ResponseCode == 00) {
            $bill = new Bill();
            $max_bill = $bill->max('id');
            $id_order = 'DH'.date("Y").($max_bill+1);
            $bill_ID =
                Bill::create(array(
                        'id_order'=>$id_order,
                        'name'=>$name,
                        'email'=>$email,
                        'phone'=>$phone,
                        'address'=>$address,
                        'note'=>$note,
                        'count'=>$count,
                        'total'=>$price_to_pay,
                        'payment_status'=>$payment_status,
                        'delivery_status'=>$delivery_status,
                    )
                );

            // var_dump($insert_bill);
            if ($bill_ID) {
                $cart = session()->get('cart', []);
                $detail_bill = new Detail_Bill();

                foreach ($cart as $item) {
                    Detail_Bill::create(array(
                            'name'=>$item['name'],
                            'quantity'=>$item['quantity'],
                            'price'=>$item['price'],
                            'image'=>$item['image'],
                            'id_order'=>$id_order
                        )
                    );
                }
                foreach(session()->get('cart') as $key=>$item) {
                    unset($cart[$key]);
                    session()->put('cart', $cart);
                }
                $categories = new Category();
                $data = $categories->all(array('name', 'id'));
                $data_detail_bill = Detail_Bill::where('id_order', '=', $id_order)->get();
                $data_bill = Bill::where('id_order', '=', $id_order)->get();
                return view('/client/cart/result', [
                    'detail_bill'=>$data_detail_bill,
                    'bill' => $data_bill,
                    'categories' => $data,
                    'message'=>'Đặt hàng và thanh toán thành công!'
                ]);
            } else {
                $categories = new Category();
                $data = $categories->all(array('name', 'id'));
                return view('/client/cart/cart', [
                    'categories' => $data,
                    'message'=>'Thanh toán thất bại!'
                ]);
            }
        }
        else {
            $categories = new Category();
            $data = $categories->all(array('name', 'id'));
            return view('/client/cart/cart', [
                'categories' => $data,
                'message'=>'Thanh toán thất bại!'
            ]);
        }
    }
}
