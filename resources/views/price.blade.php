@extends('layouts.layout')

@section('title','Прайс-лист')

@section('main_content')
<main class="bg-light py-5">
    <div class="container">
    
        <h1 class="mb-4">Прайс-лист</h1>
<div class="container-fluid p-0 mb-3">
    <div class="table-responsive">
        <table class="table data-table table-bordered table-hover">
            <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Наименование</th>
                  <!-- <th scope="col">Категория</th> -->
                  <th scope="col">Стоимость, ₽</th>
                </tr>
            </thead>
            <tbody>
                <tbody class="bg-white">

                  @foreach($plants as $plant)
                  <tr>
                    <th scope="row">{{$plant->id}}</th>
                    <td>{{$plant->title}}</td>
                    <!-- <td>{{$plant->categories->title}}</td> -->
                    <td>{{$plant->price}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </tbody>
        </table>
    </div>
</div>
        

        {{ $plants -> appends(['s'=>request()->s]) -> links('vendor.pagination.bootstrap-4') }}

    </div>
</main>

@endsection