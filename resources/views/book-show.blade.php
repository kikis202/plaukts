<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Grāmata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/book-itself.css') }}" />

  </head>
  <body>
    <div class="base">
      <x-navbar/>
      <section class="book">
        <div class = "book-info">
            <div class="book-cover">
                <img src="{{ asset('storage/'.$book->image) }}" alt="Book cover">
                
            </div>
        </div>

        <div class = "book-info2">
          <h5>{{ $book->title }}</h5>
          <ul>
              <li>{{ $book->author }}</li>
          </ul>
          <h4>Vērtējums</h4>
          <div class="hide"> Mans plaukts lietotāju vidējais vertējums:</div>
          <p id="book-apraksts">@if($book->description){{ $book->description }}@else {{'Grāmatas apraksts'}}@endif</p>
          <a class="button" href="{{ '/review/'.$book->id.'/create' }}">Sniegt atsauksmi</a>
        </div>
        @if(count(auth()->user()->plaukti) != 0)
      </section>
      <div class="pievienot-book-savam-plauktam">
      
        <form method="POST" action="{{ action([App\Http\Controllers\PlauktsController::class, 'store_book'] ) }}">
          <select>
            <option value="0">Izvelieties plauktu:</option>
            @foreach(auth()->user()->plaukti as $plaukts)
                <option value="{{$plaukts->id}}">{{ $plaukts->name }}</option>
            @endforeach
          </select>
          <input type="submit" value="Pievienot plauktam">
        </form>
      </div>
      @endif
      <div class="pievienot-book-savam-plauktam">
        
      </div>
      <section class="lietotaju-atsauksmes">
        @foreach($book->reviews as $review)
        <div class="flexbox">
          <div class="atsauksme-autors">
            <div class="profile-picture">
              <img src="{{ asset('/storage/'.$review->user->profile->image) }}" alt="Profile picture">
            </div>
            <div class="autora-vards">
              <h4>{{ '@'.$review->user->username }}</h4>
            </div>
          </div>
          
          <div class="atsauksme">
            <h5 class="atsauksmes-nosaukums">{{ $review->title }}</h5>
            <h4>{{ $review->grade }}</h4>
            <p>{{ $review->review }}</p>
          </div>
        </div>
        @endforeach
      </section>
      <footer><p class="footer">&copy; 2022 Copyright: Grāmatu Plaukts</p></footer>
    </div>

  </body>
</html>