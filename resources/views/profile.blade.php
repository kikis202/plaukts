<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-user.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}" />
    @stack('styles')
  </head>
  <body>
    <div class="base">
      <x-navbar/>
      <x-profile-search/>
      <section class="profile">
        <div class="bg-overlay">
            <div class="grid-container">
                <div class = "lietotaja-info">
                    <div class="profile-img">
                        <img src="{{ asset('storage/'.$user->profile->image) }}" alt="profile pic">
                    </div>
                    
                    <div class = "pamatinfo-profils">
                        <h5>{{ '@'.$user->username }}</h5>
                        <ul>
                            <li>{{ $user->name }}</li>
                        </ul>
                        <p id="more-info-profile">{{ $user->profile->description }}</p>
                    </div>
                </div>

                <div class="displayed-books">
                    <!--<div class="displayed-books-virsraksts">
                        <h4 class="text-center upper">Rekomendētās grāmatas</h4>
                    </div>-->
                    @if($user->profile->book1)
                    <div class="book-on-display" id="first-book">
                        <ul>
                            <li>
                                <a href="https://www.amazon.com/book1" target="_blank" title="Book1">
                                    <img alt="Addie LaRue book cover, 5th anniversary edition" src="addielaruecover.jpg">
                                    <div class="book-head">
                                        #1
                                    </div>
                                    <div class="atsauksme-profila">
                                        <h5>Vērtējums</h5>
                                        <a href="links-uz-atsauksmes-lasisanas-skatu">Atsauksme</a>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @if($user->profile->book2)
                    <div class="book-on-display" id="second-book">
                        <ul>
                            <li>
                                <a href="https://www.amazon.com/book2" target="_blank" title="Book2">
                                    <img src="addielaruecover.jpg" alt="Book2">
                                    <div class="book-head">
                                        #2
                                    </div>
                                    <div class="atsauksme-profila">
                                        <h5>Vērtējums</h5>
                                        <a href="links-uz-atsauksmes-lasisanas-skatu">Atsauksme</a>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @if($user->profile->book3)
                    <div class="book-on-display" id="third-book">
                        <ul>
                            <li>
                                <a href="https://www.amazon.com/book2" target="_blank" title="Book2">
                                    <img src="addielaruecover.jpg" alt="Book2">
                                    <div class="book-head">
                                        #3
                                    </div>
                                    <div class="atsauksme-profila">
                                        <h5>Vērtējums</h5>
                                        <a href="links-uz-atsauksmes-lasisanas-skatu">Atsauksme</a>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
      </section>
      @if(auth()->user()->username == $user->username or auth()->user()->isAdmin())
      <x-edit-profile/>
      @endif
      <x-footer/>
    </div>

  </body>
</html>