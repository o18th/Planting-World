<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Plants;
use App\Models\Reviews;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy('created_at', 'desc') -> get();
        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_category = new Categories();
        $new_category -> title = $request -> title;
        $new_category -> save();

        return redirect() -> back() -> withSuccess('Категория добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $select_category = Categories::find($id);
        $categories = Categories::orderBy('created_at', 'desc') -> get();
        $plants = Plants::where('cat_id', $id)->orderBy('created_at', 'DESC')->paginate(12);
        $reviews = Reviews::orderBy('id')->where('is_verified', 1)->get();
        return view('category.show', [
            'plants' => $plants,
            'select_category' => $select_category,
            'categories' => $categories,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::find($id);
        return view('admin.categories.edit', [
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categories = Categories::find($id);
        $categories -> title = $request -> title;
        $categories -> save();
        return redirect() -> back() -> withSuccess('Категория изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Categories::find($id);
        $categories -> delete();
        return redirect() -> back() -> withSuccess('Категория удалена');
    }
}
