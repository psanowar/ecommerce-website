<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>

  <style type="text/css">
    
    .table_design{
      border: 2px solid white;
      width: 100%;
      margin: auto;
      text-align: center;
    }

    .img_design{

      width: 150px;
      height: 100px;

    }

    .th_design{
      padding: 3px;
    }

  </style>

  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
          <div class="content-wrapper">


          	<h1 style="text-align: center; font-size:25px; padding-bottom:40px">All Order</h1>

            <div style="padding-bottom: 20px; float: right;">
              
              <form action="{{ url('search')}}" method="get">

                @csrf
                
                <input style="color:black;" type="text" name="search" placeholder="Srearch">
                <input type="submit" value="Search" class="btn btn-outline-primary">

              </form>

            </div>

            <table class="table_design">
              
              <tr style="background: tomato;">
                <th class="th_design">Name</th>
                <th class="th_design">Email</th>
                <th class="th_design">Address</th>
                <th class="th_design">Poduct Title</th>
                <th class="th_design">Quantity</th>
                <th class="th_design">Price</th>
                <th class="th_design">Payment Status</th>
                <th class="th_design">Delivery Status</th>
                <th class="th_design">Image</th>
                <th class="th_design">Delivered</th>
                <th class="th_design">Print PDF</th>
              </tr>

              @forelse($order as $order)

              <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->title }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->price }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->delivery_status }}</td>
                <td>
                  
                  <img class="img_design" src="product/{{ $order->image }}">

                </td>

                <td>

                  @if($order->delivery_status == 'processing')
                  
                  <a href="{{ url('delivered',$order->id) }}" onclick="return confirm('Are You Want to Deliverec')" class="btn btn-primary">Delivered</a>

                  @else

                  <p style="color:green">Delivered</p>

                  @endif

                </td>

                <td>
                  
                  <a href="{{ url('print_pdf',$order->id) }}" class="btn btn-secondary">Print PDF</a>

                </td>

              </tr>

              @empty

              <tr>
                <td colspan="16">
                  No Data Found
                </td>
              </tr>

              @endforelse

            </table>

          </div>	
        </div>  


    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>