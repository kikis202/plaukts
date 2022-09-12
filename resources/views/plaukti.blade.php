<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Visi mani plaukti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plaukti.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-book.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  </head>
  <body>
    <div class="base">
      <x-navbar/>
      
      <section>
        <div class="new-plaukts">
            @if(auth()->user()->id == $user->id)
            <form method="POST" action="{{ action([App\Http\Controllers\PlauktsController::class, 'store'], $user->username) }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input class="form-button" type="submit" value="Pievienot jaunu plauktu">
            </form>
            @endif
        </div>
      </section>
      <section class="Plaukti">
        @if(!$user->plaukti->count())
        @else
        @foreach ($user->plaukti as $plaukts)
            <section class="Plaukts-individuals">
                <div class="displayed-books-virsraksts">
                    <h4>{{ $plaukts->name }}</h4>
                </div>

                <div class="plaukts">
                    @for ($i = 0; $i < 3; $i++)
                        @if($i == $plaukts->user_books()->count())
                            @break
                        @endif
                        <div class="book-plaukta">
                            <ul>
                                <li>
                                    <a href="{{ '/b/'.$plaukts->user_books[$i]->book->id }}" >
                                        <img src="{{ asset('storage/'.$plaukts->user_books[$i]->book->image) }}">
                                        <div class="book-head">
                                            {{ '#'.($i +1)  }}
                                        </div>
                                        <div class="nosaukums">
                                            <h5>{{ $plaukts->user_books[$i]->book->title }}</h5>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endfor
                    
                    

                    <div class="book-plaukta" id="skatit-visu-plauktu">
                        <ul>
                            <li>
                                <a href="{{ '/plaukti/'.$plaukts->id }}">
                                    <img id="more-books" src="{{ asset('png\logo.png') }}">
                                    <div class="nosaukums">
                                        <h5>Apskatīt visu plauktu</h5>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="edit-plauktu">
                    @if(auth()->user()->id == $user->id)
                    
                    <a class="edit-button" href="{{ '/plaukti/'.$plaukts->id.'/edit' }}">Rediģēt plauktu</a>
                    @endif
                </div>
            </section>
        @endforeach
        @endif
      </section>
      <footer><p class="footer">&copy; 2022 Copyright: Grāmatu Plaukts</p></footer>
    </div>

  </body>
</html>