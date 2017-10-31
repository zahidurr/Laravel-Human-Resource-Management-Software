<!-- Ajax file to display total unread notices notification -->
@if($total_unread_notices > 0)
    <span class="label label-important" style="display: block; position: absolute; top:0; margin-left: 10px;">
        {{ $total_unread_notices }}
    </span>
@endif
