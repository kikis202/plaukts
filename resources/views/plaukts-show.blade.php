<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Meklēt grāmatu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-book.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-results.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  </head>
  <body>
    <div class="base">
      <x-navbar/>

      <section class="search-books">
        <div class="search-book">
            <a href="/books" class="form-button">Pievienot jaunu grāmatu</a>
        </div>
      </section>
      <section class="search-results">
        <div class="result-table">
            @if( $plaukts->user_books()->count() == 0 )
                <p id="error-no-users">Plaukts ir tukšs</p>
            @else
            <table class="search-results">
                <tr>
                    <th> Grāmatas attēls</th>
                    <th> Grāmatas nosaukums </th>
                    <th> Autors </th>
                    <th> Izņemt no plaukta</th>
                </tr>
                @foreach ($plaukts->user_books as $user_book)
                <tr>
                    <td> <img src="{{ asset('storage/'.$user_book->book->image) }}"> </td>
                    <td> {{ $user_book->book->title }} </td>
                    <td> {{ $user_book->book->author }} </td>
                    <td>
                        <form method="POST" action="{{ action([App\Http\Controllers\PlauktsController::class, 'destroy_user_book']) }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_book_id" value="{{ $user_book->id }}">
                            <input type="submit" class="form-button" value="Izņemt grāmatu">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <@endif
        </div>
      </section>
      <footer><p class="footer">&copy; 2022 Copyright: Grāmatu Plaukts</p></footer>
    </div>

  </body>
</html>