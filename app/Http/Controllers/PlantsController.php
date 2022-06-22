<?php

namespace App\Http\Controllers;

use App\Models\Plants;
use App\Models\Categories;
use Illuminate\Http\Request;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        $plants = Plants::orderBy('created_at', 'desc') -> paginate(8);
        $categories = Categories::orderBy('created_at', 'desc') -> get();
        return view('admin.plants.index', [
            'plants' => $plants,
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
        $categories = Categories::orderBy('created_at', 'DESC')->get();
        return view('admin.plants.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plants = new Plants();
        $plants -> title = $request -> title;
        $plants -> desc = $request -> desc;
        $plants -> price = $request -> price;
        $plants -> cat_id = $request -> cat_id;
        
        $plants -> img = "img/plants/" . $_FILES['img']['name'];

        if (!empty($_FILES)) {
            move_uploaded_file(
                $_FILES['img']['tmp_name'],
                "img/plants/" . $_FILES['img']['name']
            );
        }

        $plants -> save();
        return Redirect() -> back() -> withSuccess("Товар добавлен");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $plant = Plants::find($id);
        // $categories = Categories::orderBy('created_at', 'DESC')->get();
        // return view('plant.show', [
        //     'plant' => $plant,
        //     'categories' => $categories,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plants = Plants::find($id);
        $categories = Categories::orderBy('created_at', 'DESC')->get();
        return view('admin.plants.edit', [
            'categories' => $categories,
            'plants' => $plants
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plants = Plants::find($id);
        $plants -> title = $request -> title;
        $plants -> desc = $request -> desc;
        $plants -> price = $request -> price;
        $plants -> cat_id = $request -> cat_id;
        
        $plants -> img = "img/plants/" . $_FILES['imgRed']['name'];

        if (!empty($_FILES)) {
            move_uploaded_file(
                $_FILES['imgRed']['tmp_name'],
                "img/plants/" . $_FILES['imgRed']['name']
            );
        }
        
        if (!empty($_FILES['imgRed']['name'] == "")) {
            $plants -> img = $request -> imgHidden;
        }

        $plants -> save();
        return Redirect() -> back() -> withSuccess("Товар обновлён");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plants = Plants::find($id);
        $plants -> delete();
        return redirect() -> back() -> withSuccess('Товар удалён');
    }
}
