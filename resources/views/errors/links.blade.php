<div class="top-right links">
    @auth
        <a href="{{ route('home') }}">{{Auth::user()->username}}</a>
    @else
        <a href="{{ route('login') }}">ورود</a>
    @endauth
</div>