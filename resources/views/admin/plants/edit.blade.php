@extends('layouts.admin')

@section('title','Редактирование товара')

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


			    <h1 class="app-page-title">Изменение товара № {{$plants['id']}}</h1>
			    <!-- <hr class="mb-4"> -->
                <div class="row g-4 settings-section">
	                
	                <div class="">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">

                                
                                <form class="settings-form" action="{{route('plants.update', $plants['id'])}}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
									
									<div class="app-card-body row no-gutters">
										<div class="col-md-4 pr-md-4">
											<img src="/{{$plants['img']}}" class="card-img"> <br> <br>
											<input type="file" name="imgRed" value="{{$plants['img']}}" class="form-control">
                                        	<input type="hidden" name="imgHidden" value="{{$plants['img']}}"> <br> <br>
										</div>

										

										<div class="col-md-8">
											<div class="mb-4">
                      	            			<label for="setting-input-2">Название</label>
                                        		<input type="text" value="{{$plants['title']}}" name="title" class="form-control" id="setting-input-2" placeholder="Введите название товара" minlength="10" maxlength="100" required>
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
                    	            			<label for="desc">Введите описание</label>
                    	            			<textarea name="desc" class="form-control" id="desc" minlength="10" required>
                                    		        {{$plants['desc']}}
                                    		    </textarea>
						            		</div>
						            		<div class="mb-4">
                                    			<label for="price">Стоимость</label>
                                    			<input type="number" value="{{$plants['price']}}" name="price" id="price" class="form-control" min="1" required>
						            		</div>
											
											<button type="submit" class="btn btn-success">Обновить</button>
    									</div>
						    	    </div>
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

