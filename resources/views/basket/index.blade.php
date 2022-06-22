@extends('layouts.layout')
@section('title','Корзина')
@section('main_content')


<main class="bg-light py-5">
    <div class="container">
        <h1 class="mb-4">Корзина</h1>
        
        @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="p-5 user-select-none" style="{{ session('basket')!=null? 'display:none' : 'display:block' }}">
            <div class="row justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('img/empty-cart.svg') }}" style="height: 80px;">
                    <div class="text-center mt-3">
                        <h2>Корзина пуста</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-2">
            @php
                $sum = 0;
            @endphp
            <div class="col col-lg-8 mb-5 ">
                <div class="card border-light shadow-sm" style="{{ session('basket')!=null? 'display:block' : 'display:none' }}">
                    @if(session('basket'))
                        <ul class="list-group list-group-flush">
                            @foreach(session('basket') as $id=>$details)
                                <li class="list-group-item py-4">
                                    <div class="row">
                                        <div class="col-4 col-md-3">
                                            <img src="{{ asset($details['image']) }}" class="w-100"/>
                                        </div>
                                        <div class="col-8 col-md-6">
                                            <h5 class="">{{ $details['nameProduct'] }}</h5>

                                            <form action="{{route('deleteProductBasket')}}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" name="product_id" value="{{ $details['product_id'] }}" class="btn text-dark p-0 mt-3">
                                                    <img src="{{ asset('img/delete.svg') }}" style="height: 20px;">
                                                    <span class="align-middle ml-1">Удалить</span>
                                                </button>
                                            </form>
                                            <!-- <a href="#" class="text-decoration-none text-dark mt-5">
                                            </a> -->
                                        </div>
                                        <div class="col-12 col-md-3 row justify-content-end">
                                            <div>
                                                
                                            <h5 class="user-select-none font-weight-bold">{{ number_format($details['countBasket'] * $details['price'], 2, ',', ' ') }} ₽</h5>
                                            
                                            @if($details['countBasket']!=1)
                                                <p class="text-muted user-select-none">{{ number_format($details['price'], 2, ',', ' ') }} ₽<sub>/шт.</sub></p>
                                            @endif

                                            <div class="btn-group mt-2">
                                                <form action="{{route('PlusProductBasket')}}" class="btn-group" name="F1" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-light border rounded-left btn-sm px-3 font-weight-bold text-monospace" name="product_idPlus" value="{{ $details['product_id'] }}">+</button>
                                                    <!-- <button type="submit" class="btn btn-light border btn-sm px-3 font-weight-bold text-monospace" {{($details['countBasket'] > $details['kolProduct'])? 'disabled' : ""}} name="product_idPlus" value="{{ $details['product_id'] }}">+</button> -->
                                                </form>

                                                <span class="px-3 py-1 border-bottom border-top text-monospace">
                                                    {{ $details['countBasket'] }}
                                                </span>

                                                <form action="{{route('MinusProductBasket')}}" class="btn-group" name="F2" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-light border rounded-right btn-sm px-3 font-weight-bold text-monospace" {{$details['countBasket'] <= 1 ? 'disabled' : ''}} name="product_idMinus" value="{{ $details['product_id'] }}">&mdash;</button>
                                                </form>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $sum += $details['countBasket'] * $details['price'];
                                    @endphp
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            
            <div class="col col-lg-4 col-sm-6" style="{{ session('basket')!=null? 'display:block' : 'display:none' }}">
                <div class="card">
                    <div class="card-body">
                            <h5 class="card-title row justify-content-between mx-0">
                                <span>Итого</span>
                                <span class="user-select-none font-weight-bold">
                                    @php
                                        echo number_format($sum, 2, ',', ' ') . ' ₽';
                                    @endphp
                                </span>
                            </h5>
                        <!-- <h6 class="card-subtitle mb-2 text-muted">Оплата при получении</h6> -->
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of     the card's content.             </p> -->
                        
                        <form action="{{route('OrderProduct')}}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="sum" name="sum" value="{{ $sum }}">
                            <button type="submit" class="btn btn-success mt-3">Оформить заказ</button>
                        </form>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</main>


                


@endsection