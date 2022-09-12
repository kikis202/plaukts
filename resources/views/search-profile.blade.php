<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-results.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search-user.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}" />
    @stack('styles')
  </head>
  <body>
    <div class="base">
      <x-navbar/>
      <x-profile-search/>
      <section class="search-results">
        <div class="result-table">
          @if(empty($profiles))
           <p id="error-no-users"> Lūdzu aizpildiet filtru!</p>
           @else
            @if (count($profiles) == 0)
            <p id="error-no-users"> Datubāzē nav atbilstošu ierakstu</p>
            @else
            <table class="search-results">
                <tr>
                    <th> Profila foto</th>
                    <th> Lietotājvārds </th>
                    <th> Vārds </th>
                    <th> Apskatīt </th>
                </tr>
                @foreach ($profiles as $user)
                <tr>
                    <td> <img class="user-img" src="{{ asset('storage/'.$user->profile->image) }}"></td>
                    <td> {{ $user->username }} </td>
                    <td> {{ $user->name }} </td>
                    <td> 
                      <div class="profile-pic-head">
                        <a href="{{ url('profile/'.$user->username)}}">Apskatīt</a>
                      </div>
                    </td>
                </tr>
                @endforeach

            </table>
            @endif
          @endif
        </div>
      </section>
      <x-footer/>
    </div>

    <script>
      function showProfile(username){
        window.location.href = "/profile/" + username;
      }
    </script>

  </body>
</html>
