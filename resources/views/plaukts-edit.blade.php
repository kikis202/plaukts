<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Visi mani plaukti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plaukti.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  </head>
  <body>
    <div class="base">
      <x-navbar/>
      
      <section>
        <div class="new-plaukts">
        </div>
      </section>
      @if(auth()->user()->id == $plaukts->user->id)
      <section class="Plaukti">
            <section class="Plaukts-individuals">
                <div class="displayed-books-virsraksts">
                    <form method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input id="change-title-area" type="text" name="name" placeholder="Nosaukums" value="{{ $plaukts->name }}">
                        <input id="change-info-button" type="submit" value="Mainīt informāciju">
                    </form>
                </div>
                @for ($i = 0; $i < 3; $i++)
                        @if($i == $plaukts->user_books()->count())
                            @break
                        @endif
                        <div class="book-plaukta">
                            <ul>
                                <li>
                                    <a href="" title="Book1">
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
                <div class="dzest-plauktu">
                    <form method="POST" action="{{ action([App\Http\Controllers\PlauktsController::class, 'destroy'], $plaukts->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="edit-button" value="Dzēst plauktu">
                    </form>
                </div>
            </section>
      </section>
      @else
      <p>Šis nav jūsu plaukts</p>
      @endif
      <footer><p class="footer">&copy; 2022 Copyright: Grāmatu Plaukts</p></footer>
    </div>

  </body>
</html>