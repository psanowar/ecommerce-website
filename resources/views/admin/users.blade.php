<!DOCTYPE html>
<html lang="en">
  <head>

  	<style type="text/css">
  		.table_deg{

  		width: 50%;
        margin-top: 50px;
        border: 2px solid white;
        text-align: center;
  		}
  	</style>

    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
      <div class="main-panel">
          <div class="content-wrapper">

          	@if(session()->has('msg'))
          		<div class="alert alert-success">
          			<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button>
          			{{ session()->get('msg') }}

          		</div>
          	@endif

          	<table class="table_deg">
          		<tr>
          			<th>Name</th>
          			<th>Email</th>
          			<th>Phone</th>
          			<th>Address</th>
          			<th>Action</th>
          		</tr>

          		@foreach($data as $data)
          		<tr>
          			<td>{{ $data->name }}</td>
          			<td>{{ $data->email }}</td>
          			<td>{{ $data->phone }}</td>
          			<td>{{ $data->address }}</td>
          			<td>

          				@if($data->usertype=='0')
          				<a class="btn btn-danger" href="{{ url('deleteuser',$data->id) }}">Delete</a>
          				@else
          				<a>Not Allowed</a>

          				@endif
          			</td>
          		</tr>
          		@endforeach
          	</table>



          </div>	
      </div>	
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>