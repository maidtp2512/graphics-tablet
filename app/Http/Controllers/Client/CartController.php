<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
}
