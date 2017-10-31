 <!-- Left menu for admin panel -->
@if (Auth::check())
    @if(Auth::user()->role == 1)
        @include('layouts.left_menu_admin')
    @endif
@endif
