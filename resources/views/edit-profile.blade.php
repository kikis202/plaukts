<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit-profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}" />
  </head>
  <body>
    <div class="base">
      <x-navbar/>
      <section class="atstarpe"></section>
      <section class="profile">
        <div class="bg-overlay">
            <div class="grid-container">
                <div class = "lietotaja-info">
                    <div class="profile-img">
                        <img src="{{ asset('storage/'.$user->profile->image) }}" alt="profile picture">
                    </div>
                    
                    <div class = "pamatinfo-profils">
                        <form method="POST" action="{{ action([App\Http\Controllers\ProfileController::class, 'update'], $user->username) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h1>Izvēlieties citu profila foto:</h1>
                            <input id="izveleties-foto" type="file" id="myFile" name="photo">
                            <h5>Lietotājvārds</h5>
                            <input id="change-name-area" type="text" name="name" placeholder="Vārds">
                            <textarea id="textarea-change-profile" name="description" placeholder="Par sevi" rows="4" cols="50">{{ $user->profile->description }}</textarea>
                            <input id="change-info-button" type="submit" value="Mainīt informāciju">
                        </form>
                        @if ($errors->any())
                            <div>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500 list-none"> {{$error}} </li>
                            @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="displayed-books">
                    <div class="book-on-display" id="first-book">
                        <ul>
                            <li>
                                <a href="" target="_blank" title="Book1">
                                    @if($user->book1)
                                    <img alt="" src="{{ App\Models\Book::findOrFail($user->book1)->image }}">
                                    
                                    <div class="book-head">
                                        #1
                                    </div>
                                    <div class="pick-another-book">
                                        <a href="links-uz-gramatu-izvelnes-skatu">Izveleties citu grāmatu</a>
                                    </div>
                                    @else
                                    <div class="pick-another-book">
                                        <a href="links-uz-gramatu-izvelnes-skatu">Izvēlies mīļāko grāmatu</a>
                                    </div>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                    @if($user->book1)
                    <div class="book-on-display" id="second-book">
                        <ul>
                            <li>
                                <a href="" target="_blank" title="Book2">
                                    @if($user->book2)
                                    <img alt="" src="{{ App\Models\Book::findOrFail($user->book2)->image }}">
                                    
                                    <div class="book-head">
                                        #2
                                    </div>
                                    <div class="pick-another-book">
                                        <a href="links-uz-gramatu-izvelnes-skatu">Izveleties citu grāmatu</a>
                                    </div>
                                    @else
                                    <div class="pick-another-book">
                                        <a href="links-uz-gramatu-izvelnes-skatu">Izvēlies otru mīļāko grāmatu</a>
                                    </div>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                    @if($user->book2)
                    <div class="book-on-display" id="third-book">
                        <ul>
                            <li>
                                <a href="" target="_blank" title="Book2">
                                    @if($user->book3)
                                    <img alt="" src="{{ App\Models\Book::findOrFail($user->book3)->image }}">
                                    
                                    <div class="book-head">
                                        #1
                                    </div>
                                    <div class="pick-another-book">
                                        <a href="links-uz-gramatu-izvelnes-skatu">Izveleties citu grāmatu</a>
                                    </div>
                                    @else
                                    <div class="pick-another-book">
                                        <a href="links-uz-gramatu-izvelnes-skatu">Izvēlies mīļāko grāmatu</a>
                                    </div>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @endif
                    
                </div>
            </div>
        </div>
      </section>
      <section class="delete-profile">
        <div class="profile-pic-head">
            <a href="delete-profile.html">Delete Profile</a>
        </div>
      </section>
      <footer><p class="footer">&copy; 2022 Copyright: Grāmatu Plaukts</p></footer>
    </div>

  </body>
</html>