@extends('layouts.layout')

@section('title','Каталог')

@section('main_content')

<main class="bg-light py-5">
  <div class="container">

    <h1 class="mb-4">{{$select_category['title']}}</h1>
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      @foreach($errors->all() as $error)
        {{ $error }}
      @endforeach
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card-columns">
      @forelse($plants as $plant)
          <div class="card">
            <img src="{{ asset($plant['img']) }}" class="card-img-top user-select-none" alt="{{$plant['title']}}">
              <div class="card-body border-top">
                <h5 class="card-title user-select-none text-truncate">{{$plant['title']}}</h5>
                <p class="card-text user-select-none">{{$plant->categories['title']}}</p>
                <p class="card-text plnt-price user-select-none">{{$plant['price']}} <sup>₽</sup><sub>/шт.</sub></p>
                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#modal-{{$plant['id']}}">
                  Подробнее
                </button>
              </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{$plant['id']}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel-{{$plant['id']}}" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="ModalLabel-{{$plant['id']}}">{{$plant['title']}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body p-4">
                    <div class="row mb-4">
                      <div class="col-md-5 mb-4"><img src="{{ asset($plant['img']) }}" class="p-2 w-100 border rounded-lg"></div>
                      <div class="col-md-7">
                        <!-- <h3 class="card-title bg-white mt-3 plnt-title">{{$plant['title']}}</h3> -->
                        <p class="mb-4">{{$plant->categories['title']}}</p>
                        <h3 class="user-select-none mb-4 plnt-price-main">{{$plant['price']}} <sup>₽</sup><sub>/шт.</sub></h3>
                        @guest
                          <a class="btn btn-success btn-lg pl-5 pr-5" href="{{ route('login') }}">{{ __('Войти') }}</a>
                        @else
                          <form action="{{ route('basket.add', ['id' => $plant->id]) }}" method="post">
                            @csrf 
                            @method('POST')
                            <button class="btn btn-success btn-lg px-5 py-2 btn-sm" type="submit">Добавить в корзину</button>
                          </form>
                        @endguest
                      </div>
                    </div>
                        <h4>Описание</h4>
                        <p class="card-text ">
                          {{$plant['desc']}}
                        </p>

                        <h4>Отзывы</h4>
                        @guest
                          @foreach($reviews as $review)
                            @if($review['plant_id'] == $plant['id'])
                              <div class="card">
                                <h6 class="card-header">{{$review->user['name']}}</h6>
                                <div class="card-body">
                                  <p class="card-text">{{$review['subject']}}</p>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        @else
                          @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                  <p>{{ $error }}</p>
                                @endforeach
                            </div>
                          @endif

                          <form action="/catalog/check" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="plant_id" id="plant_id" value="{{$plant['id']}}">
                            <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                            
                            <textarea name="subject" id="subject" placeholder="Место для вашего отзыва" class="form-control mb-2"></textarea>
                            <button type="submit" class="btn btn-success">Отправить</button>
                          </form>

                          @foreach($reviews as $review)
                            @if($review['plant_id'] == $plant['id'])
                              <div class="card">
                                <h6 class="card-header">{{$review->user['name']}}</h6>
                                <div class="card-body">
                                  <p class="card-text">{{$review['subject']}}</p>
                                </div>
                              </div>
                            @endif
                          @endforeach
                  
                        @endguest
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
    </div>
        <div class="p-5 user-select-none">
            <div class="row justify-content-center">
                <div class="text-center">
                    <div class="text-center mt-3">
                        <h2>Товары отсутствуют</h2>
                    </div>
                </div>
            </div>
        </div><div>
        @endforelse
    </div>


    {{ $plants -> appends(['s'=>request()->s]) -> links('vendor.pagination.bootstrap-4') }}
    
  </div>
</main>

@endsection