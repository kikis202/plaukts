<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Meklēt grāmatu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/add-new-book.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  </head>
  <body>
    <div class="base">
      <x-navbar/>
      <section class="adding-a-book">
        <div class="add-book">
            <form method="POST" action="{{ action([App\Http\Controllers\ReviewController::class, 'store']) }}">
                @csrf
                @method('POST')
                <input id="autors-pievienot" type="text" name="title" placeholder="Atsauksmes virsraksts">
                <input id="nosaukums-pievienot" type="number" name="grade" placeholder="10">
                <textarea id="textarea-par-gramatu" name="review" placeholder="Tava atsauksme" rows="4" cols="50"></textarea>
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input id="book-search-button" type="submit" value="Pievienot">
            </form>
            @if ($errors->any())
                <div class>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 list-none"> {{$error}} </li>

                @endforeach
                </div>
            @endif
        </div>
      </section>

      <footer><p class="footer">&copy; 2022 Copyright: Grāmatu Plaukts</p></footer>
    </div>

  </body>
</html>