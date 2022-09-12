<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Meklēt grāmatu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-results.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-user.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-book.css') }}" />
  </head>
  <body>
    <div class="base">
      <x-navbar/>
      <section class="search-books">
        <div class="search-book">
            <form method="POST" action="{{ action([App\Http\Controllers\BookController::class, 'filter']) }}">
                @csrf
                @method('POST')
                <input id="autors-meklet" type="text" name="title" placeholder="Meklēt pēc nosaukuma">
                <input id="nosaukums-meklet" type="text" name="author" placeholder="Meklēt pēc autora">
                <input class="form-button" type="submit" value="Meklēt">
            </form>
            @if(auth()->user()->isAdmin())
            <a href="{{ '/b/create' }}" class="form-button">Pievienot grāmatu</a>
            @endif
        </div>
      </section>
      <section class="search-results">
        <div class="result-table">
            @if(empty($books))
                <p id="error-no-users">Lūdzu aizpildiet filtru!</p>
            @else
                @if(count($books) == 0)
                    <p id="error-no-users">Datubāzē nav atbilstošu ierakstu</p>
                @else
                    <table class="search-results">
                        <tr>
                            <th> Grāmatas attēls</th>
                            <th> Grāmatas nosaukums </th>
                            <th> Autors </th>
                            @if(count(auth()->user()->plaukti) != 0)
                            <th> Pievienot plauktam</th>
                            @endif
                            @if(auth()->user()->isAdmin())
                            <th> Reģidēt grāmatu </th>
                            <th> Dzēst grāmatu </th>
                            @endif
                        </tr>

                        @foreach ($books as $book)
                        <tr>
                            <td> <img src="{{ asset('storage/'.$book->image) }}"> </td>
                            <td> {{$book->title}} </td>
                            <td> {{$book->author}} </td>
                            @if(count(auth()->user()->plaukti) != 0)
                            <td> 
                              <form method="POST" action="{{ action([App\Http\Controllers\PlauktsController::class, 'store_book'] ) }}">
                              @csrf
                              @method('POST')
                              <input type="hidden" name="book_id" value="{{$book->id}}">
                              <select name="plaukts_id">
                                  <option value="0">Izvēlēties plauktu</option>
                                  @foreach(auth()->user()->plaukti as $plaukts)
                                  <option value="{{$plaukts->id}}">{{ $plaukts->name }}</option>
                                  @endforeach
                                </select>
                                <input type="submit" class="tabula-button" value="Pievienot">
                              </form>
                            </td>
                            @endif
                            @if(auth()->user()->isAdmin())
                            <td> <a class="tabula-button" href="">Reģidēt</a> </td>
                            <td> 
                              <form method="POST" action="{{ action([App\Http\Controllers\BookController::class, 'destroy']) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $book->id }}">
                                <input type="submit" class="tabula-button" value="Izņemt grāmatu">
                              </form> 
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                @endif
            @endif
        </div>
      </section>
      <footer><p class="footer">&copy; 2022 Copyright: Grāmatu Plaukts</p></footer>
    </div>

  </body>
</html>