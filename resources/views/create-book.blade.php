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
            <form method="POST" enctype="multipart/form-data" action="{{ action([App\Http\Controllers\BookController::class, 'store']) }}">
                @csrf
                @method('POST')
                <input id="autors-pievienot" type="text" name="author" placeholder="Autora vārds">
                <input id="nosaukums-pievienot" type="text" name="title" placeholder="Grāmatas nosaukums">
                <h1>Izvēlieties grāmatas vāka foto:</h1>
                <input id="izveleties-foto" type="file" id="myFile" name="cover">
                <textarea id="textarea-par-gramatu" name="description" placeholder="Grāmatas apraksts" rows="4" cols="50"></textarea>
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