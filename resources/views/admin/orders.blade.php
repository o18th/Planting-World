@extends('layouts.admin')

@section('title','Заказы')

@section('content')

<div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Заказы</h1>
                
                <form action="{{ route('admin.orders') }}" method="get" class="mb-3">
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
                    <button type="submit" class="btn btn-success btn-sm rounded">Показать</button>
                </form>

                <div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-4">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Номер<br>заказа</th>
												<th class="cell">Дата</th>
												<th class="cell">Email пользователя</th>
												<th class="cell">Стомость<br>заказа (₽)</th>
												<th class="cell">Статус</th>
												<th class="cell">Примечание</th>
												<th class="cell">Изменение<br>статуса</th>
												<!-- <th class="cell"></th> -->
											</tr>
										</thead>
										<tbody>
											@foreach($orders as $order)
											    <tr>
											    	<td class="cell">{{$order->id}}</td>
											    	<td class="cell">{{$order->created_at}}</td>
											    	<td class="cell">{{$order->OrderUser->email}}</td>
											    	<td class="cell">{{$order->full_price}}</td>
											    	<td class="cell">
                                                        @switch($order->OrderStatus->id)
                                                            @case(1)
                                                                <span class="badge bg-warning py-1 px-2">
                                                                @break
                                                            @case(2)
                                                                <span class="badge bg-success py-1 px-2">
                                                                @break
                                                            @case(3)
                                                                <span class="badge bg-danger py-1 px-2">
                                                                @break
                                                            @case(4)
                                                                <span class="badge bg-secondary py-1 px-2">
                                                                @break
                                                            @default
                                                                <span class="py-1 px-2">
                                                                @break
                                                        @endswitch
                                                            {{$order->OrderStatus->nameStatus}}
                                                        </span>
                                                    </td>
                                                    <form action="{{route('admin.order.edit')}}" method="POST">
                                                        @csrf
											    	    <td class="cell">
                                                            <textarea name="note" id="note" cols="20" class="form-control">{{$order->note}}
                                                            </textarea>
                                                        </td>
											    	    <td class="cell">
                                                            @if($order->status_id==3||$order->status_id==4)
                                                                <input type="hidden" name="status_id" id="status_id" value="{{$order->status_id}}">
                                                            @endif
                                                            <select class="form-select form-select-sm w-auto" name="status_id" id="status_id" @if($order->status_id==3||$order->status_id==4) disabled @endif>	
											                    @foreach($statuses as $status)
								                                    <option {{$order->OrderStatus->id==$status->id?'selected=""':''}} value="{{$status->id}}">{{$status->nameStatus}}</option>
											                    @endforeach
                                                            </select>
                                                        </td>
											    	    <td class="cell">
                                                            <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                                                            <button type="submit" class="rounded app-btn-secondary">Изменить</button>
                                                        </td>
                                                    </form>
											    </tr>

                                            
											@endforeach
		
										</tbody>
									</table>
                                    
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
                        
					
				</div>


				<nav class="app-pagination">
					{{ $orders -> appends(['s'=>request()->s]) -> links('vendor.pagination.bootstrap-4') }}
				</nav>

                
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
    </div><!--//app-wrapper-->  

@endsection


