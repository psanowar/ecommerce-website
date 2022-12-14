<!DOCTYPE html>
<html>
   <head>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
      @include('home.css')

      <style type="text/css">
         
         .cart_center{

            margin: auto;
            width: 70%;
            text-align: center;


         }

         table,th,td{

            border: 1px solid black;

         }

         .th_design{

            font-size: 30px;
            padding: 5px;
            background: tomato;

         }
         .img_design{

            height: 200px;
            width: 200px;
         }
         .div_deg{
            text-align: center;
         }
         .total_design{
            font-size: 20px;
            padding: 40px;
         }


      </style>

   </head>
   <body>

      @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

         @if(session()->has('msg'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button>
                {{ session()->get('msg') }}

              </div>
            @endif
         
         <div>
            
            <table class="cart_center">

            <tr>

               <th class="th_design">Title</th>
               <th class="th_design">Quantity</th>
               <th class="th_design">Price</th>
               <th class="th_design">Image</th>
               <th class="th_design">Action</th>

            </tr>

            <?php $totalprice = 0; ?>

            @foreach($cart as $cart)

            <tr>

               <td>{{ $cart->title }}</td>
               <td>{{ $cart->quantity }}</td>
               <td>${{ $cart->price }}</td>
               <td class="img_design"><img src="product/{{ $cart->image }}"></td>
               <td>
                  <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('remove_cart',$cart->id) }}">Remove Product</a>
               </td>

            </tr>

            <?php $totalprice = $totalprice + $cart->price ?>

            @endforeach

            
         </table>
         
            <div class="div_deg">
               <h1 class="total_design">Total price : ${{ $totalprice }}</h1>
            </div>

            <div style="text-align:center; padding-bottom: 15px;">
               
               <h1 style="font-size: 20px; padding-bottom: 10px;">Proceed to Order</h1>

               <a class="btn btn-danger" href="{{ url('cash_order') }}">Cash On Delivery</a>

               <a class="btn btn-danger" href="{{ url('stripe',$totalprice) }}">Pay Using Card</a>

            </div>

            
         </div>

      </div>
      <!-- footer start -->
     
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">?? 2022 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>


      <!-- start sweetalert function  -->

      <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to cancel this product",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((Cancel) => {
            if (Cancel) {


                 
                window.location.href = urlToRedirect;
               
            }  


               });

        
            }
         </script>

         <!-- end sweetalert function  -->


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