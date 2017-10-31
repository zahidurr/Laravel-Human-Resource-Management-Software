<!-- Page title -->
@section('title')
    Leave Request Details
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
                           <div class="muted pull-left">Leave Request Details</div>
                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <h3>{{ $leave->type }}</h3>

                               <div class="row-fluid">
                                   <div class="span7">
                                       <span class="titleText">Reason:</span>
                                       {{ $leave->reason }}
                                       <br><br>

                                        <span class="titleText">From Date:</span>
                                        {{ date("Y-M-j", strtotime($leave->from_date)) }}

                                        <br>

                                        <span class="titleText">To Date:</span>
                                        {{ date("Y-M-j", strtotime($leave->to_date)) }}

                                   </div>
                                   <div class="span5">
                                       <!-- block -->
                                       <br>
                                       <div class="div-box">
                                           <span class="titleText">Status:</span>

                                           @if($leave->status == 1)
                                                <i class="fa fa-check-square" style="color:green;"></i> Approved
                                           @elseif($leave->status == 2)
                                                <i class="fa fa-times" style="color:red;"></i> Rejected
                                           @else
                                                <i class="fa fa-clock-o" style="color:orange;"></i> Pending
                                           @endif

                                            <br><br>

                                            <span class="titleText">Comment:</span>
                                               {{ $leave->moderator_comment }}

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
