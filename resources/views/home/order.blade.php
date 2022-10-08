<!DOCTYPE html>
<html>
   <head>
      
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/ecom.jpg" type="">
      <title>Ecommerce Website</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <style type="text/css">
         
         .center{

            margin: auto;
            width: 70%;
            text-align: center;

         }

         table,th,td{

            border: 1px solid black;

         }

         .th_deg{
            background-color: tomato;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;

         }

      </style>

   </head>
   <body>

         <!-- header section strats -->
         @include('home.header')
         

         <div class="center">
            
            <table>
               
               <tr>
                  <th class="th_deg">Product Title</th>
                  <th class="th_deg">Quantity</th>
                  <th class="th_deg">Price</th>
                  <th class="th_deg">Payment Status</th>
                  <th class="th_deg">Delivery Status</th>
                  <th class="th_deg">Image</th>
                  <th class="th_deg">Cancel Order</th>
               </tr>

               @foreach($order as $order)
               <tr>
                  <td>{{ $order->title }}</td>
                  <td>{{ $order->quantity }}</td>
                  <td>{{ $order->price }}</td>
                  <td>{{ $order->payment_status }}</td>
                  <td>{{ $order->delivery_status }}</td>
                  <td>
                     <img width="100px" height="100px" src="product/{{$order->image}}">
                  </td>

                  <td>
                     @if($order->delivery_status == 'processing')
                     <a onclick="return confirm('Are you sure to cancel this order')" class="btn btn-danger" href="{{ url('cancelorder',$order->id) }}">Cancel Order</a>

                     @else

                     <p>Not Allowed</p>

                     @endif
                  </td>
               </tr>
               @endforeach

            </table>

         </div>

         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
       

        
      
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>