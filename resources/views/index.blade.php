@extends('layouts.layout')

@section('title','Главная')

@section('main_content')
<main class="bg-light py-5">
    <div class="container">


      <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner rounded-lg border">
          <div class="carousel-item active" data-interval="10000">
            <img src="img/slider/scott-webb-hDyO6rr3kqk-unsplash.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" data-interval="2000">
            <img src="img/slider/pawel-czerwinski-lWBZ01XRRoI-unsplash.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/slider/sarah-dorweiler-9Z1KRIfpBTM-unsplash.png" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="mt-5">
        <h3>Категории</h3>
        <div class="row row-cols-2 row-cols-md-4 mt-3">
          @foreach($categories as $category)
          <div class="col mb-4">
            <div class="card text-center justify-content-center h-100">
              <a href="{{route('category.show', $category->id)}}" class="text-decoration-none text-reset">
                <img src="img/categories/botanic{{$category->id}}.png" class="card-img-top px-5">
                <div class="card-body">
                  <h5 class="card-title">{{$category->title}}</h5>
                  <p class="card-text"><small class="text-muted">{{$category->count}} товаров</small></p>
                </div>
               </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>

    <div class="mt-4">
      <h3>Новинки</h3>

      <div class="v-scroll-cont pb-2" id="gray-scroll">
      @foreach ($plants as $plant)
        <div class="v-scroll-item mr-2 p-0 col-7 col-md-5 col-lg-3">
            <div class="card ">
              <img src="{{$plant['img']}}" class="card-img-top user-select-none" alt="{{$plant['title']}}">
              <div class="card-body border-top">
                <h5 class="card-title user-select-none text-truncate">{{$plant['title']}}</h5>
                <p class="card-text user-select-none">{{$plant->categories['title']}}</p>
                <p class="card-text plnt-price user-select-none">{{$plant['price']}} <sup>₽</sup><sub>/шт.</sub></p>
                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#modal-{{$plant['id']}}">
                  Подробнее
                </button>
              </div>
            </div>
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
                          <!-- <pre>{{$plant['desc']}}</pre> -->
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
                            
                            <textarea name="subject" id="subject" placeholder="Место для вашего отзыва" class="form-control mb-2" style="min-height: 70px; max-height: 140px;"></textarea>
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
      @endforeach
      </div>
    </div>

    </div>
</main>

@endsection