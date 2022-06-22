<?php

namespace App\Http\Controllers;

use App\Models\Plants;
use App\Models\Categories;
use App\Models\Reviews;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Обязательная авторизация
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $plants = Plants::orderBy('created_at', 'DESC')->limit(6)->get();
        $reviews = Reviews::orderBy('id')->where('is_verified', 1)->get();
        $categories = DB::select('
        select count(*) count,
        c.id,
        c.title
   from plants p
         join categories c on c.id = p.cat_id
 group by p.cat_id       
        ');
        // $categories = Categories::orderBy('id')->get();
        return view('index', [
            'categories' => $categories,
            'plants' => $plants,
            'reviews' => $reviews,
        ]);
    }

    public function adminHome()
    {
        $statuses = Status::all();
        $plants_count = Plants::all()->count();
        $categories_count = Categories::all()->count();
        $users_count = User::all()->count();
        $reviews_count = Reviews::all()->count();
        $orders = DB::select('
            select  count(*) count,
                    s.id,
                    s.nameStatus
            from orders o
            join statuses s on s.id = o.status_id
            group by o.status_id
        ');
        return view('admin.index', [
            'plants_count' => $plants_count,
            'users_count' => $users_count,
            'categories_count' => $categories_count,
            'reviews_count' => $reviews_count,
            'orders' => $orders,
        ]);
    }
    
    public function catalog()
    {
        $plants = Plants::orderBy('created_at', 'DESC') -> paginate(12);
        $categories = Categories::orderBy('id')->get();
        $reviews = Reviews::orderBy('id')->where('is_verified', 1)->get();
        return view('catalog', [
            'plants' => $plants,
            'categories' => $categories,
            'reviews' => $reviews,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request -> search;
        $plants = Plants::where('title', 'LIKE', "%{$search}%")-> orderBy('created_at', 'DESC') ->paginate(12);
        $categories = Categories::orderBy('id')->get();
        $reviews = Reviews::orderBy('id')->where('is_verified', 1)->get();
        
        $result = $search;
        return view('search', [
            'plants' => $plants,
            'categories' => $categories,
            'reviews' => $reviews,
            'search' => $result,
        ]);
    }

    public function review_check(Request $request)
    {
        $valid = $request -> validate([
            'plant_id' => 'required|min:1|max:5',
            'user_id' => 'required|min:1|max:5',
            'subject' => 'required|min:10|max:500',
        ]);
        
        $review = new Reviews();
        $review -> user_id = $request -> input('user_id');
        $review -> plant_id = $request -> input('plant_id');
        $review -> subject = $request -> input('subject');

        $review -> save();
        return redirect()->back()->withSuccess("Отзыв добавлен");
    }
    
    
    public function about()
    {
        $categories = Categories::orderBy('id')->get();
        return view('about', [
            'categories' => $categories
        ]);
    }
    
    public function orders(Request $request)
    {
        $id = auth()->user()->id;
        $status_filter = $request -> status_filter;
        $status = Status::all();
        $user = User::find($id);

        if ($status_filter == 0 || $status_filter == null) {
            $orders = Order::orderBy('created_at', 'DESC')->where('user_id', '=', $id)->get(); 
        } else {
            $orders = Order::orderBy('created_at', 'DESC')->where('user_id', '=', $id)->where('status_id', '=', $status_filter)->get();
        }
        
        $result = Status::find($status_filter);
        $categories = Categories::orderBy('id')->get();
        return view('orders', [
            'categories' => $categories,
            'orders' => $orders,
            'user'=>$user,
            'statuses' => $status,
            'status_filter' => $status_filter,
            'result' => $result,
        ]);
    }

    
    public function cancel_order(Request $request)
    {
        $order = Order::find($request -> order_id);
        $order -> status_id = $request -> status;

        $order -> save();
        return redirect()->back();
    }
    
    public function admin_orders(Request $request)
    {
        $status_filter = $request -> status_filter;
        // $orders = Order::orderBy('created_at', 'DESC')->get();
        $status = Status::all();

        if ($status_filter == 0 || $status_filter == null) {
            $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        } else {
            $orders = Order::orderBy('created_at', 'DESC')->where('status_id', '=', $status_filter)->paginate(5);
        }

        // $result = Status::find($status_filter);
        return view('admin.orders', [
            'orders' => $orders,
            'statuses' => $status,
            'status_filter' => $status_filter,
            // 'result' => $result,
        ]);
    }
    
    public function order_edit(Request $request)
    {
        $order = Order::find($request -> order_id);
        $order -> status_id = $request -> status_id;
        $order -> note = $request -> note;

        $order -> save();
        return redirect()->back();
    }

    public function price()
    {
        $plants = Plants::orderBy('created_at', 'DESC')->paginate(20);
        $categories = Categories::orderBy('id')->get();
        return view('price', [
            'plants' => $plants,
            'categories' => $categories,
        ]);
    }
}
