<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               

               <div style="padding:30px">

                  <form action="{{ url('product_search') }}" method="get">
                     @csrf
                     <input style="width:400px;" type="text" name="search" placeholder="Search">
                     <input type="submit" value="Search">
                  </form>

               </div>

            </div>

            @if(session()->has('msg'))
                 <div class="alert alert-success">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button>
                   {{ session()->get('msg') }}

                 </div>
            @endif

            <div class="row">

               @foreach($product as $products)

               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{ url('product_details',$products->id) }}" class="option1">
                           Product Details
                           </a>

                              <form action="{{ url('add_cart', $products->id) }}" method="post">

                                 @csrf
                                 
                              
                              <div class="row">

                                 <div class="col-md-4">

                                    <input type="number" name="quantity" value="1" min="1" style="width:100px">

                                 </div>

                                 <div class="col-md-4">

                                    <input type="submit" value="Add To Cart">

                                 </div>

                              </div>


                              </form>

                              

                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{ $products->image }}" alt="">
                     </div> 
                     <div class="detail-box">

                        <h5>
                           {{ $products->title }}
                        </h5>

                        @if ($products->dis_price!=null)

                        <h6 style="color:red">
                           Discount price<br>
                           ${{ $products->dis_price }}
                        </h6>   

                        <h6 style="text-decoration: line-through; color: blue">
                           Regular price<br>
                           ${{ $products->price }}
                        </h6>

                        @else
                        <h6 style="color: blue">
                           Regular price<br>
                           ${{ $products->price }}
                        </h6>

                        @endif

                        

                     </div>
                  </div>
               </div>

               @endforeach

               <span style="padding-top: 20px;">

               {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}

               </span>

               </div>
         </div>
      </section>