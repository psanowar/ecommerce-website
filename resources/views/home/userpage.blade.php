<!DOCTYPE html>
<html>
   <head>
    
      @include('home.css')


   </head>
   <body>

      @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.new_arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.products')


      <!-- Comment and reply system starts here -->

      <div style="text-align: center; padding-bottom:30px;">
          <h1 style="font-size: 25px; text-align: center; padding-bottom:20px;">Comments</h1>

          <form action="{{ url('add_comment') }}" method="post">
            @csrf
              <textarea style="height: 100px; width: 500px;" placeholder="comments here" name="comment"></textarea>
              <br>

              <input type="submit" class="btn btn-primary" value="Comments">
          </form>

      </div>


      <div style="padding-left: 15%; padding-bottom:20px">
          <h1 style="font-size20px; padding-bottom:20px">All Comments</h1>


          @foreach($comment as $comment)

          <div>

              <b>{{ $comment->name }}</b>
              <p style="padding-bottom:10px;">{{ $comment->comment }}</p>

              <a style="color:blue;" href="javascript::void(0);" onclick="reply(this)" dataCommentId = "{{ $comment->id }}">Reply</a>

              @foreach($reply as $rep)

              @if($rep->comment_id == $comment->id)
              <div style="padding-left:3%; padding-top: 10px; padding-bottom: 10px;">

                    <b>{{ $rep->name }}</b>
                    <p>{{ $rep->reply }}</p>

                    <a style="color:blue;" href="javascript::void(0);" onclick="reply(this)" dataCommentId = "{{ $comment->id }}">Reply</a>

              </div>
              @endif

              @endforeach

          </div>

          @endforeach

          

          <!-- Reply system -->

          <div style="display:none;" class="replydiv">

            <form action="{{ url('add_reply') }}" method="post">
                @csrf

            <input type="text" id="commentId" name="commentId" hidden="">

            <textarea style="height:100px; width:500px;" placeholder="reply is here" name="reply"></textarea>
            <br>
            <button class="btn btn-warning" type="submit">Reply</button>

            <a href="javascript::void(0);" class="btn" onclick="reply_close(this)">Close</a>

            </form>

          </div>



      </div>
      

      <!-- Comment and reply system starts here -->



      <!-- end product section -->

      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2022 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>




      <script type="text/javascript">
          
        function reply(caller){

            document.getElementById('commentId').value = $(caller).attr('dataCommentId');

            $('.replydiv').insertAfter($(caller));
            $('.replydiv').show();

        }

        function reply_close(caller){

    
            $('.replydiv').hide();

        }

      </script>



      <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>



      

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