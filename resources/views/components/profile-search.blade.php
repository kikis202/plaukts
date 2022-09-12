@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search-user.css') }}" />
@endpush

<section class="edit-profile-search-users">
        <div class="search-user">
            <form method="POST" action="{{ action([App\Http\Controllers\ProfileController::class, 'filter']) }}">
                @csrf
                @method('POST')
                <input type="text" name="username" placeholder="@username">
                <input id="user-search-button" type="submit" value="Meklēt">
            </form>
        </div>
      </section>