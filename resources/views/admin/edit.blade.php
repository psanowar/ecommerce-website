<!DOCTYPE html>
<html lang="en">
  <head>

  	<base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
    	
    	.h2_font{
    		font-size: 40px;
    		padding-bottom: 40px;
    	}
    	.div_color{
    		color: black;
    	}
    	label{
    		display: inline-block;
    		width: 150px;
    	}
    	.div_padding{
    		padding-bottom: 10px;
    	}


    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            @if(session()->has('msg'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button>
                {{ session()->get('msg') }}

              </div>
            @endif

          	<div>
          		<h2 class="h2_font">Update Product</h2>

          		<form action="{{ url('update_product',$product->id) }}" method="POST" enctype="multipart/form-data">
          			@csrf
          			<div class="div_padding">
          				<label>Product title</label>
          				<input class="div_color" type="text" name="title" placeholder="title" required="" value="{{ $product->title }}">
          			</div>

          			<div class="div_padding">
          				<label>Product description</label>
          				<input class="div_color" type="text" name="description" placeholder="description" required="" value="{{ $product->description }}">
          			</div>

          			<div class="div_padding">
          				<label>Product Price</label>
          				<input class="div_color" type="number" name="price" placeholder="price" required="" value="{{ $product->price }}">
          			</div>

          			<div class="div_padding">
          				<label>Product Discount</label>
          				<input class="div_color" type="number" name="dis_price" placeholder="title" value="{{ $product->dis_price }}">
          			</div>

          			<div class="div_padding">
          				<label>Product Quantity</label>
          				<input class="div_color" type="number" min="0" name="quantity" placeholder="quantity" required="" value="{{ $product->quantity }}">
          			</div>

          			<div class="div_padding">
          				<label>Product Category</label>
          				<select class="div_color" name="category" required="">

          					<option value="{{ $product->category }}" selected="">{{ $product->category }}</option>

          					@foreach($category as $category)
          					<option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
          					@endforeach
                    
          				</select>
          			</div>

          			<div class="div_padding">
          				<label>Current Product Image</label>
          				<img style="margin-left: 150px;" height="100" width="100" src="/product/{{ $product->image }}">
          			</div>

          			<div class="div_padding">
          				<label>Change Product Image</label>
          				<input type="file" name="image">
          			</div>

          			<div class="div_padding">
          				<input type="submit" class="btn btn-primary" value="Update Product">
          			</div>

          		</form>

          	</div>
          </div>
        </div>  	
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>