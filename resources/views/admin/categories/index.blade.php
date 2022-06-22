@extends('layouts.admin')

@section('title','Категории')

@section('content')

<div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
				
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
			    
			    <h1 class="app-page-title">Категории</h1>

                <div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">ID</th>
												<th class="cell">Название</th>
												<th class="cell">Дата создания</th>
												<th class="cell">Дата изменения</th>
												<!-- <th class="cell">Customer</th>
												<th class="cell">Status</th>
												<th class="cell">Total</th> -->
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
											@foreach($categories as $category)
											<tr>
												<td class="cell">{{$category['id']}}</td>
												<td class="cell"><span class="truncate">{{$category['title']}}</span></td>
												<td class="cell"><span>
													<span class="note">{{$category['created_at']}}</span>
												</td>
												<td class="cell"><span>
													<span class="note">{{$category['updated_at']}}</span>
												</td>
												<!-- <td class="cell">John Sanders</td>
												<td class="cell"><span class="badge bg-success">Paid</span></td>
												<td class="cell">$259.35</td> -->
												<td class="cell">
													<a class="btn-sm app-btn-secondary" href="{{route('categories.edit', $category['id'])}}">Редактировать</a>
													
													<form action="{{route('categories.destroy', $category['id'])}}" method="POST" style="display: inline-block">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn-sm app-btn-secondary" >Удалить</button>
													</form>
												</td>
											</tr>
											@endforeach
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
					
				</div>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
    </div><!--//app-wrapper-->  

@endsection


