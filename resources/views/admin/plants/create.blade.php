@extends('layouts.admin')

@section('title','Новый товар')

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


			    <h1 class="app-page-title">Добавление товара</h1>
			    <!-- <hr class="mb-4"> -->
                <div class="row g-4 settings-section">
	                
	                <div class="">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">

							    <form class="settings-form" action="{{route('plants.store')}}" method="POST" enctype="multipart/form-data">

									  @method('POST')
									  @csrf
										<div class="mb-4">
                      						<label for="text">Название</label>
											<input type="text" name="title" class="form-control" id="setting-input-2" required>
										</div>
										<div class="mb-4">
                    						<label for="text">Введите описание</label>
                    						<textarea name="desc" class="form-control" id="desc" minlength="10" required></textarea>
										</div>
										<div class="mb-4">
                        					<label for="cat_id">Выбирите категорию</label>
                        					<select name="cat_id" class="form-control custom-select" id="cat_id" required>
                        					    @foreach ($categories as $category)
                        					        <option value="{{$category['id']}}">{{$category['title']}}</option>
                        					    @endforeach
                        					</select>
										</div>
										<div class="mb-4">
                        					<label for="exampleInputCategory">Стоимость</label>
                        					<input type="number" name="price" class="form-control" placeholder="Введите название товара" min="1" required>
										</div>
										<div class="mb-4">
                        					<label for="img">Изображение товара</label>
                        					<input type="file" name="img" class="form-control" required>
										</div>
										<button type="submit" class="btn btn-success">Добавить</button>
                    
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

