@extends('layouts.admin')

@section('title','Изменение категории')

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


			    <h1 class="app-page-title">Изменение категории: {{$categories['title']}}</h1>
			    <!-- <hr class="mb-4"> -->
                <div class="row g-4 settings-section">
	                
	                <div class="">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">

							    <form class="settings-form" action="{{route('categories.update', $categories['id'])}}" method="POST">
									@method('PUT')
									@csrf
									<div class="mb-4">
									    <label for="setting-input-2" class="form-label">Название</label>
									    <input type="text" name="title" value="{{$categories['title']}}" class="form-control" id="setting-input-2" required="">
									</div>
									<button type="submit" class="btn btn-success">Обновить</button>
							    </form>

						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div>
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    <!--//app-footer-->
	    
</div>

@endsection


