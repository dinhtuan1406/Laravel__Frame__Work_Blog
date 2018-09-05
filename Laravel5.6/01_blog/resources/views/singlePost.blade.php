
@extends("layouts.master")
@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('assets/img/post-bg.jpg') }}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h2>{{ $post->title }}</h2>
              <span class="meta">Posted by
                <a href="#">{{ $post->user->name }}</a>
                on {{ date_format($post->created_at,'F d, Y')}} 
              </span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
             {!! nl2br($post->content) !!}
          </div>
        </div>

        <div class="comments">
         
          <hr>
          <h2>Comments</h2>
          <hr>
          @foreach($post->comments as $comment)
          <p>{{ $comment->content }}</p>
          </br>
          <p><small>{{ $comment->user->name }} on {{ date_format($comment->created_at,'F d,Y')}} </small></p>
          <hr>
          @endforeach

          @if(Auth::check())

            <form action="{{route('newComment')}}">
                  <div class="form-group">
                        <textarea class="form-control" placeholder="Comment" name="comment" id= col"30" rows="10"> </textarea>
                  </div>
                  <div class="form group">
                    <button class="btn btn-primary" type="submit">Make Comment </button>
                  </div>
            </form>

          @endif
        </div>
       
      </div>

     

    </article>
    
   

@endsection   
  