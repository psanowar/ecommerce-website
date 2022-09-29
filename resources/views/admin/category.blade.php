<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
    	
    	.h2_font{
    		font-size: 40px;
    		padding-bottom: 40px;
    	}
    	.input_color{
    		color: black;
    	}
      .input_table{
        width: 32%;
        margin-top: 30px;
        border: 2px solid white;
        text-align: center;
        
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
          		<h2 class="h2_font">Add Category</h2>

          		<form action="{{ url('add_category') }}" method="POST">
          			@csrf

          			<input class="input_color" type="text" name="category_name" placeholder="Category name">
          			<input type="submit" class="btn btn-primary" name="submit" value="Add Category">
          		</form>
          	</div>

            <table class="input_table">
              <tr>
                <td>Category Name</td>
                <td>Action</td>
              </tr>

              @foreach($data as $data)
              <tr>
                <td>{{ $data->category_name }}</td>
                <td>
                  <a onclick="return confirm('Are you want to delete')" class="btn btn-danger" href="{{ url('delete_category',$data->id) }}">Delete</a>
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