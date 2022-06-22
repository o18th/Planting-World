@extends('layouts.admin')

@section('title','Отзывы')

@section('content')

<div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Отзывы</h1>
				@if(session('success'))
				<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">
						    <h3>{{ session('success') }}</h3>
						    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					    </div><!--//app-card-body-->
				    </div><!--//inner-->
			    </div>
        		@endif

                <div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-4">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">ID</th>
												<th class="cell">Email пользователя</th>
												<th class="cell">ID товара</th>
												<th class="cell">Содержание</th>
												<th class="cell">Модерация</th>
												<th class="cell">Дата создания</th>
												<th class="cell"></th>
												<!-- <th class="cell"></th> -->
											</tr>
										</thead>
										<tbody>
											@foreach($reviews as $review)
											<tr>
												<td class="cell">{{$review['id']}}</td>
												<td class="cell">{{$review->user['email']}}</td>
												<td class="cell">{{$review['plant_id']}}</td>
												<td class="cell">
                                                    <!-- <span class="truncate">{{$review['subject']}}</span> -->
                                                    <textarea name="" id="" cols="50"  class="form-control" readonly>
                                                        {{$review['subject']}}
                                                    </textarea>
                                                </td>
												<td class="cell">
                                                    @if($review['is_verified'])
                                                        <form action="/admin/reviews/check" method="POST" class="mb-4">
                                                            @csrf
                                                            <input type="hidden" name="id" id="id" value="{{$review['id']}}">
                                                            <input type="hidden" name="plant_id" id="plant_id" value="{{$review['plant_id']}}">
                                                            <input type="hidden" name="user_id" id="user_id" value="{{$review['user_id']}}">
                                                            <input type="hidden" name="subject" id="subject" value="{{$review['subject']}}">

                                                            <input type="hidden" name="is_verified" id="is_verified" value="0">
                                                            <button type="submit" class="btn text-light px-2 py-1 badge bg-success">Показать</button>
                                                        </form>
                                                    @else
                                                        <form action="/admin/reviews/check" method="POST" class="mb-4">
                                                            @csrf
                                                            <input type="hidden" name="id" id="id" value="{{$review['id']}}">
                                                            <input type="hidden" name="plant_id" id="plant_id" value="{{$review['plant_id']}}">
                                                            <input type="hidden" name="user_id" id="user_id" value="{{$review['user_id']}}">
                                                            <input type="hidden" name="subject" id="subject" value="{{$review['subject']}}">

                                                            <input type="hidden" name="is_verified" id="is_verified" value="1">
                                                            <button type="submit" class="btn text-light px-2 py-1 badge bg-danger">Скрыть</button>
                                                        </form>
                                                    @endif
                                                </td>
												<td class="cell">
													<span class="note">{{$review['created_at']}}</span>
												</td>
												<td class="cell">
													<span class="note">
														<form action="{{route('reviews.destroy')}}" method="post">
                                            			    @csrf
                                            			    @method('DELETE')
                                            			    <button type="submit" name="id" value="{{$review['id']}}" class="btn text-dark">
                                            			        <img src="{{ asset('img/delete.svg') }}" style="height: 20px;">
                                            			        <!-- <span class="align-middle ml-1">Удалить</span> -->
                                            			    </button>
                                            			</form>
													</span>
												</td>
												<!-- <td class="cell">
                                                    <button class="btn-sm app-btn-secondary">Посмотреть</button>
												</td> -->
											</tr>

                                            
											@endforeach
		
										</tbody>
									</table>
                                    
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
                        
					
				</div>

				
				<nav class="app-pagination">
					{{ $reviews -> appends(['s'=>request()->s]) -> links('vendor.pagination.bootstrap-4') }}
				</nav>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
    </div><!--//app-wrapper-->  

@endsection


