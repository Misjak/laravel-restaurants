@extends('layouts.app')




 @section ('restaurant detail')

    <h1>Restaurant</h1>

    {{$restaurant->name}} <br>
    {{$restaurant->city}} <br>
    {{$restaurant->description}} <strong>


    <h2>Comments</h2>
 

      @foreach ($restaurant->comments as $comment)

        <div style="border:1px solid black">
            Name:
            <strong>{{ $comment->user->name }}</strong><br>
            <br>
            Comment: <br>
            <pre>{{ $comment->comment }}</pre>
            Created at: <br>
            <p>{{ $comment->created_at}}</p>

          <form action="{{ action('CommentReplyController@store', $comment->id)}}" method="post">
            @csrf
            <textarea name="comment" id="" cols="30" rows="2"></textarea>
            <button type="submit" value="reply">Reply</button>
          </form>
           
      
          @if ($comment->user_id === Auth::user()->id)
           <form action="{{ action('RestaurantRegistrationController@delete', $comment->id)}}" method="post">
            @csrf
            @method('delete')
           
            <button value="delete">Delete comment</button>
            
          </form>   
          @endif
        
          
      @endforeach

@auth 
      <form action="{{ action('RestaurantRegistrationController@store', $restaurant->id)}}" method="post">
      @csrf
      Your comment: <br>
      <textarea name="comment" id="" cols="30" rows="5"></textarea>
      <br>
      <button type="submit" value="save">Submit</button>
      
    </form>


@endauth

  @guest
  
    <h2>Please <a href="{{ route ('login')}}">login</a> to leave comment</h2>

@endguest
    
@endsection