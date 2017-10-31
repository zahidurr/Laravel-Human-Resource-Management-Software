 <!-- redirect to header top bar -->
@if (Auth::check())
    @if(Auth::user()->role == 1)
        @include('layouts.top_bar_admin')
    @elseif(Auth::user()->role == 2)
        @include('layouts.top_bar_employee')
    @endif
@endif
