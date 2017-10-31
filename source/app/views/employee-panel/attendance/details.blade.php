<!-- Page title -->
@section('title')
    Attendance Details
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
                           <div class="muted pull-left">Attendance Details</div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">

                            <!-- Form view  -->
                           {{ Form::open(array('url' => '/employee-panel/attendance-details', 'method' => 'GET', 'style' => 'text-align:center;')) }}
                           <fieldset>
                               <div class="control-group">

                                 <div class="controls">

                                 {{ Form::select('monthly_attendance', $monthly_attendance_options, $monthly_attendance, array('onChange' => 'this.form.submit()')) }}

                                 </div>
                               </div>
                           </fieldset>
                           {{ Form::close() }}

                            <!-- table -->
                           <table class="table table-bordered">
                             <thead>
                                 <tr>
                                     <th>Day #</th>
                                     <th>Date</th>
                                     <th>Punch In</th>
                                     <th>Punch Out</th>
                                     <th>Status</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @for($i=1; $i<=$month_days; $i++)

                                 @if($monthly_in_time[$i]  != '' && $monthly_in_time[$i]  <= "$settings->office_hour_start:00")
                                    <tr class="success">
                                 @elseif($monthly_in_time[$i] > "$settings->office_hour_start:00")
                                    <tr class="warning">
                                 @else
                                    <tr class="error">
                                 @endif

                                     <td>{{ $i }}</td>
                                     <td >{{ date("l, M j", strtotime($monthly_full_date[$i])) }}</td>
                                     <td>
                                         @if($monthly_in_time[$i] != '')
                                           {{ date("g:i A", strtotime($monthly_in_time[$i])) }}
                                         @endif
                                     </td>
                                     <td>
                                         @if($monthly_out_time[$i] != '')
                                           {{ date("g:i A", strtotime($monthly_out_time[$i])) }}
                                         @endif
                                     </td>
                                     <td>
                                         @if($monthly_in_time[$i]  != '' && $monthly_in_time[$i]  <= "$settings->office_hour_start:00")
                                              <i class="fa fa-user-plus" style="color:green;"></i> Present
                                         @elseif($monthly_in_time[$i] > "$settings->office_hour_start:00")
                                              <i class="fa fa-user" style="color:orange;"></i> Late
                                         @else
                                              <i class="fa fa-user-times" style="color:red;"></i> Absent
                                         @endif
                                     </td>
                                 </tr>
                                 @endfor
                             </tbody>
                           </table>
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
