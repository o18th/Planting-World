@extends('layouts.layout')

@section('title','Заказы')

@section('main_content')
<main class="bg-light py-5">
    <div class="container">
    
        <h1 class="mb-4">Заказы</h1>

        <form action="{{ route('orders') }}" method="get" class="mb-3">
            @method('PUT') 
            @csrf
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status_filter" id="inlineRadio1" value="0" {{$status_filter==0?'checked':''}}>
                <label class="form-check-label" for="inlineRadio1">Все</label>
            </div>
            @foreach ($statuses as $status)                
                <div class="form-check form-check-inline mb-1">
                    <input class="form-check-input" type="radio" name="status_filter" id="inlineRadio1{{ $status->id }}" value="{{ $status->id }}" {{$status->id==$status_filter?'checked':''}}>
                    <label class="form-check-label" for="inlineRadio1{{ $status->id }}">{{ $status->nameStatus }}</label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-success btn-sm">Показать</button>
        </form>

        <div class="row row-cols-1 row-cols-lg-2">
            
            @foreach($orders as $order)
                <div class="col mb-4">
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col col-md-8">
                                <div class="card-body">
                                    <!-- <div class="v-scroll-cont pb-2">
                                        @foreach ($order -> OrderOrderProduct as $product)
                                            <div class="v-scroll-item">
                                                <div class="card" style="width: 12rem;">
                                                    <div class="card-body">
                                                        <img src="{{$product -> OrderProductProduct -> img }}" class="col-12">
                                                        <h6 class="card-title text-truncate" title="{{$product -> OrderProductProduct -> title }}">{{$product -> OrderProductProduct -> title }}</h6>
                                                        <p class="card-text user-select-none">{{$product -> order_price }} ₽ <sub>×{{$product -> quantity}} шт.</sub></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div> -->
                                    <div class="v-scroll-cont pb-2">
                                        @foreach ($order -> OrderOrderProduct as $product)
                                            <div class="v-scroll-item mr-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img src="{{$product -> OrderProductProduct -> img }}" class="col-12">
                                                        <h6 class="card-title text-truncate" title="{{$product -> OrderProductProduct -> title }}">{{$product -> OrderProductProduct -> title }}</h6>
                                                        <p class="card-text user-select-none">{{$product -> order_price }} ₽ <sub>×{{$product -> quantity}} шт.</sub></p>
                                                        <!-- <a href="#" class="btn btn-success btn-sm btn-block">Подробнее</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-4 order-first">
                                <div class="card-body">
                                    <h5 class="card-title">Заказ №{{$order -> id}}</h5>
                                    <p class="card-text mb-0 ">Дата: <span class="text-muted">{{$order -> created_at -> format('d.m.Y')}}</span></p>
                                    <p class="card-text">Статус: <span class="text-muted">{{$order -> OrderStatus -> nameStatus}}</span></p>
                                    <h5 class="card-title row justify-content-between mx-0 mb-3">
                                        <span>Итого</span>
                                        <span class="user-select-none font-weight-bold">
                                            {{ number_format($order->full_price, 2, ',', ' ') }} ₽
                                        </span>
                                    </h5>
                                    @if($order -> status_id == 1)
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticBackdrop{{$order -> id}}">Отменить</a>

                                        <div class="modal fade" id="staticBackdrop{{$order -> id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel{{$order -> id}}" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel{{$order -> id}}">Заказ №{{$order -> id}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                    <p>Вы действительно хотите отменить заказ?</p>
                                                
                                                    <ul class="list-group">
                                                        @foreach ($order -> OrderOrderProduct as $product)
                                                            <li class="list-group-item">{{$product -> OrderProductProduct -> title }} <sup>×{{$product -> quantity}}</sup></li>
                                                        @endforeach
                                                    </ul>

                                                    <h5 class="card-title row justify-content-between mx-0 mt-3">
                                                        <span>Итого</span>
                                                        <span class="user-select-none font-weight-bold">
                                                            {{ number_format($order->full_price, 2, ',', ' ') }} ₽
                                                        </span>
                                                    </h5>
                                                
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>
                                                <form action="{{route('cancel_order')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_id" id="order_id" value="{{$order -> id}}">
                                                    <input type="hidden" name="status" id="status" value="3">
                                                    <button type="submit" class="btn btn-danger">Отменить заказ</button>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        


    </div>

</main>

@endsection