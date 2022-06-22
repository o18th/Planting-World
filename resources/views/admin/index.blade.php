@extends('layouts.admin')

@section('title','Главная')

@section('content')

<div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Главная</h1>
				    
			    <div class="row g-4 mb-4">

				    <div class="col-6 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Товары</h4>
							    <div class="stats-figure">{{ $plants_count}}</div>
							    <div class="stats-meta">Перейти</div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/admin/plants"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Категории</h4>
							    <div class="stats-figure">{{ $categories_count}}</div>
							    <div class="stats-meta">Перейти</div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/admin/categories"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

				    <div class="col-6 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Отзывы</h4>
							    <div class="stats-figure">{{ $reviews_count}}</div>
							    <div class="stats-meta">Перейти</div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/admin/reviews"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

				    <div class="col-6 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Пользователи</h4>
							    <div class="stats-figure">{{ $users_count}}</div>
							    <!-- <div class="stats-meta">Перейти</div> -->
						    </div><!--//app-card-body-->
						    <!-- <a class="app-card-link-mask" href="#"></a> -->
					    </div><!--//app-card-->
				    </div><!--//col-->

					


			    </div><!--//row-->

				<div class="row g-4 mb-4">

				<div class="col-12 col-lg-6">
				        <div class="app-card app-card-stats-table h-100 shadow-sm">
					        <div class="app-card-header p-3"><a href="/admin/orders" class="text-success">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title">Заказы</h4>
							        </div><!--//col-->
							        <div class="col-auto">
								        <div class="card-header-action">
									        &#10140;
								        </div><!--//card-header-actions-->
							        </div><!--//col-->
						        </div><!--//row--></a>
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-3 p-lg-4">
						        <div class="table-responsive">
							        <table class="table table-borderless mb-0">
										<thead>
											<tr>
												<th class="meta">Статус</th>
												<th class="meta stat-cell">Количество</th>
											</tr>
										</thead>
										<tbody>
											@foreach($orders as $item)
												<tr>
													<td class="">{{$item->nameStatus}}</td>
													<td class="stat-cell">{{$item->count}}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
						        </div><!--//table-responsive-->
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div>
					
				</div>

			    
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    
</div><!--//app-wrapper-->  

@endsection


