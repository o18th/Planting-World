<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Plants;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index(){
        $categories = Categories::orderBy('id')->get();
        return view('basket.index', [
            'categories' => $categories,
        ]);
    }

    public function add(Request $request, $id){
        $product = Plants::find($id);
        $basket = session()->get('basket',[]);
        if(isset($basket[$id])){
            $basket[$id]['countBasket']++;
            $basket[$id]['costBasket'] = $basket[$id]['costBasket'] * $basket[$id]['price'];
        }
        else{
            $basket[$id] = [
                "user_id" => session('IDuser'),
                "product_id" => $product->id,  
                "countBasket" => 1,
                "nameProduct" => $product -> title,
                "price" => $product -> price,
                "image" => $product -> img,
                "kolProduct" => $product -> count,
                "costBasket" => $product -> price*1
                
            ];
        }
        session()->put('basket',$basket);
        $request->session()->put('countOrder',count($basket));
        return redirect()->back()->withSuccess("Товар добавлен в корзину.");
    }

    public function PlusProductBasket(Request $request){
        if($request->product_idPlus){
            $id=$request->product_idPlus;
            $basket = session('basket');
            $basket[$id]['countBasket']++;
            session()->put('basket',$basket);
        }
        return redirect()->back();
    }

    public function MinusProductBasket(Request $request){
        if($request->product_idMinus){
            $id=$request->product_idMinus;
            $basket = session('basket');
            if($basket[$id]['countBasket'] != 1) {
                $basket[$id]['countBasket']--;
            }
            session()->put('basket',$basket);
        }
        return redirect()->back();
    }

    public function deleteProductBasket(Request $request){
        if($request->product_id){
            $id = $request->product_id;
            $basket = session('basket');
            unset($basket[$id]);
            session()->put('basket',$basket);
            $countOrder = $request->session()->put('countOrder', count($basket));
        }
        return redirect()->back();
    }

    public function OrderProduct(Request $request){
        $IDuser = auth()->user()->id;
        $pasUser = auth()->user()->password;
        // $PasswordOrder = $request -> PasswordOrder;
        $basket = session('basket');
        // if(password_verify($PasswordOrder, $pasUser)){
            $new_order = new Order();
            $new_order->user_id = $IDuser;
            $new_order->full_price = $request -> sum;
            $new_order->save();
            foreach(session('basket') as $id=>$details){
                OrderProduct::insert(array(
                    'order_id'=>$new_order->id,
                    'product_id' =>$details['product_id'],
                    'quantity' => $details['countBasket'],
                    'order_price' => $details['price'],
                ));
                $product = Plants::find($id);
                // $product->count=$product->count-$details['countBasket'];
                $product->save();
                unset($basket[$id]);
            };
            session()->put('basket',$basket);
            $request->session()->put('countOrder',count($basket));
            return redirect()->back()->withSuccess("Заказ оформлен! Вы можете узнать статус заказа на соответствующей странице.");
        // }
        // else{
            // return redirect()->back()->withSuccess("Пароль не верен");
        // }
    }
}
