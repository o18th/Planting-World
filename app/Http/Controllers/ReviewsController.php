<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\User;

use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Reviews::orderBy('id')->paginate(6);
        $user = User::orderBy('id')->get();
        return view('admin.reviews', [
            'reviews' => $reviews,
            'user' => $user,
        ]);
    }

    public function review_check(Request $request)
    {
        $id = $request -> id;
        $review = Reviews::find($id);
        $review -> plant_id = $request -> plant_id;
        $review -> user_id = $request -> user_id;
        $review -> subject = $request -> subject;
        $review -> is_verified = $request -> is_verified;

        $review -> save();
        return redirect()->route('reviews.index');
    }

    public function destroy(Request $request)
    {
        $id = $request -> id;
        $reviews = Reviews::find($id);
        $reviews -> delete();
        return redirect() -> back() -> withSuccess('Отзыв удалён');
    }
}
