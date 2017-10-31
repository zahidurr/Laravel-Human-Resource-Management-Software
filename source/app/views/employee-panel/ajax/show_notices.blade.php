<!-- Ajax file to display total notices -->
@if($notices_count > 0)
    @foreach($notices as $key => $value)
        @if($value->start_date <= date('Y-m-d') && $value->end_date >= date('Y-m-d'))
            <h4>{{ $value-> title }}</h4>
            <p>{{ $value-> description }}</p>
            <hr>
        @endif
    @endforeach
@else
    No recent notices
@endif
