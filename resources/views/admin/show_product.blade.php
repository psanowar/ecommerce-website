<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
    	
    	.div_widh{
    	width: 80%;
    	text-align: center;
    	border: 1px solid white;
    	margin-top: 40px;
    }
    .div_font{
    	font-size: 30px;
    	padding-top: 20px;
    }
    .div_design{
    	height: 100px;
    	width: 100px;
    }
    .div_color{
    	background: orange;
    }
    .th_design{
    	padding: 20px;
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

          	<h2 class="div_font">All Products</h2>

          	<table class="div_widh">
          		<tr class="div_color">
          			<th class="th_design">Title</th>
          			<th class="th_design">Description</th>
          			<th class="th_design">Category</th>
          			<th class="th_design">Price</th>
          			<th class="th_design">Discount Price</th>
          			<th class="th_design">Quantity</th>
          			<th class="th_design">Image</th>
                <th class="th_design">Delete</th>
                <th class="th_design">Edit</th>
          		</tr>

          		@foreach($product as $product)
          		<tr>
          			<td>{{ $product->title }}</td>
          			<td>{{ $product->description }}</td>
          			<td>{{ $product->category }}</td>
          			<td>{{ $product->price }}</td>
          			<td>{{ $product->dis_price }}</td>
          			<td>{{ $product->quantity }}</td>
          			<td>
          				
          				<img class="div_design" src="product/{{ $product->image }}">

          			</td>
                <td>
                  <a class="btn btn-danger" onclick="return confirm('Are you want to delete')" href="{{ url('delete_product',$product->id) }}">Delete</a>
                </td>
                <td>
                  <a class="btn btn-success" href="{{ url('edit_product',$product->id) }}">Edit</a>
                </td>
          		</tr>
          		@endforeach

          	</table>

          </div>
        </div>  	
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>