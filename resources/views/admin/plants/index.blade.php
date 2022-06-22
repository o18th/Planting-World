@extends('layouts.admin')

@section('title','Товары')

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
			    
			    <h1 class="app-page-title">Товары</h1>

				<div class="row row-cols-1 row-cols-md-2">
					@foreach($plants as $plant)
				    	<div class="col mb-4">
				    	  	<div class="card">
								<div class="app-card app-card-stats-table h-100 shadow-sm">
						    	    <div class="app-card-header p-3">
								        <div class="row justify-content-between align-items-center">
									        <div class="col-auto">
								                <h4 class="app-card-title">ID: {{$plant['id']}}</h4>
									        </div><!--//col-->
									        <div class="col-auto">
										        <div class="card-header-action">

													<a class="btn-sm app-btn-secondary" href="{{ route('plants.edit', $plant['id']) }}">Редактировать</a>
													
													<form action="{{route('plants.destroy', $plant['id'])}}" method="POST" style="display: inline-block">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn-sm app-btn-secondary" >Удалить</button>
													</form>
										        </div><!--//card-header-actions-->
									        </div><!--//col-->
								        </div><!--//row-->
						    	    </div><!--//app-card-header-->
						    	    <div class="app-card-body p-3 p-lg-4 row no-gutters">
										
										<div class="col-md-4">
											<img src="../{{$plant['img']}}" class="card-img">
										</div>
										<div class="col-md-8">
				    	      				<h5 class="card-title">{{$plant['title']}}</h5>
				    	      				<p class="card-text text-truncate">{{$plant['desc']}}</p>
											<p class="card-text user-select-none">{{$plant->categories['title']}}</p>
											<p class="card-text plnt-price user-select-none">{{$plant['price']}} <sup>₽</sup><sub>/шт.</sub></p>
    									</div>
						    	    </div><!--//app-card-body-->
				    	    	</div>

				    	  	</div>
				    	</div>
					@endforeach
					
				</div>
				<nav class="app-pagination">
					{{ $plants -> appends(['s'=>request()->s]) -> links('vendor.pagination.bootstrap-4') }}
				</nav>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
    </div><!--//app-wrapper-->  

@endsection


