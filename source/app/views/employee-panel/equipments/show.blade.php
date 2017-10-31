<!-- Page title -->
@section('title')
    Equipment Request Details
@stop

<!-- Page content to add in master layout -->
@section('content')

    <!-- Top header bar of the page. See top_bar layouts -->
    @include('layouts.top_bar')

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12" id="content">

                <div class="row-fluid">
                   <!-- block -->
                   <div class="block">

                        <!-- block header -->
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Equipment Request Details</div>
                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <h3>{{ $equipment->name }}</h3>

                               <div class="row-fluid">
                                   <div class="span7">
                                       <span class="titleText">Reason:</span>
                                       {{ $equipment->reason }}
                                       <br><br>

                                        <span class="titleText">Quantity:</span>
                                        {{ $equipment->quantity }}

                                   </div>
                                   <div class="span5">
                                       <!-- block -->
                                       <br>
                                       <div class="div-box">
                                           <span class="titleText">Status:</span>

                                           @if($equipment->status == 1)
                                                <i class="fa fa-check-square" style="color:green;"></i> Approved
                                           @elseif($equipment->status == 2)
                                                <i class="fa fa-times" style="color:red;"></i> Rejected
                                           @else
                                                <i class="fa fa-clock-o" style="color:orange;"></i> Pending
                                           @endif

                                            <br><br>

                                            <span class="titleText">Comment:</span>
                                               {{ $equipment->moderator_comment }}

                                       </div>

                                   </div>

                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- /block -->
               </div>

            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    @include('layouts.js_scripts.employee_master')
@stop
