<!-- Page title -->
@section('title')
    Dashboard
@stop

<!-- Page content to add in master layout -->
@section('content')

    <!-- Top header bar of the page. See top_bar layouts -->
    @include('layouts.top_bar')

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12" id="content">

                <!-- Display notification message here -->
                @if(App::make('UtilController')->isTodayHoliday())
                <div class="alert alert-info">
                    <h4><i class="fa fa-flag"></i> Today is holiday</h4>
                </div>
                @endif


                <div class="row-fluid">

                    <!-- Display success flash message here -->
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('success_message') }}</strong>
                    </div>
                    @endif

                    <!-- Display error flash message here -->
                    <div id="punch-in-error" ></div>
                </div>


               <div class="row-fluid">

                   <div class="span3">
                       <!-- block -->
                       <div class="block dashboard-box">

                           <!-- block header -->
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Profile</div>
                           </div>

                           <!-- block content -->
                           <div class="block-content collapse in">
                               <div class="span12 dashboard-box2">
                                   <img src="{{ asset('/uploads/images/'. App::make('UtilController')->userProfileImageName (Auth::user()->id, 'Employee')) }}" class="profile-image-big" />

                                   <h4>
                                   <a href="{{ URL::to('/employee-panel/my-profile') }}">{{ App::make('UtilController')->userFullName (Auth::user()->id, 'Employee') }}</a>
                                   </h4>
                                   <span style="color: #3A87AD;"><i class="fa fa-sitemap"></i></span> <b>Department:</b>
                                   {{ App::make('UtilController')->departmentName ($employee->department_id) }}

                                   <br>

                                   <span style="color: #3A87AD;"><i class="fa fa-user"></i></span>
                                   <b>Employee ID:</b>
                                   {{ $employee->employee_id }}

                                   <br>

                                   <span style="color: #3A87AD;"><i class="fa fa-briefcase"></i></span>
                                   <b>Designation:</b>
                                   {{ $employee->designation }}

                                   <br>

                                   <span style="color: #3A87AD;"><i class="fa fa-calendar-o"></i></span>
                                   <b>Joining Date:</b>
                                   {{ $employee->joining_date }}

                                </div>
                           </div>
                       </div>
                       <!-- /block -->
                   </div>
                   <div class="span3">
                       <!-- block -->
                       <div class="block dashboard-box">
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Attendance</div>

                           </div>
                           <div class="block-content collapse in">
                               <div class="span12 dashboard-box2">
                                   <div class="well" >
                                     <button id="attendance-punch-in" type="button" class="btn btn-large btn-block btn-success" style="display:none;" onclick="attendancePunchIn()">
                                         <i class="fa fa-credit-card fa-5x"></i>
                                         <br>
                                         Punch In
                                     </button>
                                     <button id="attendance-punch-out" type="button" class="btn btn-large btn-block btn-warning" style="display:none;" onclick="attendancePunchOut()">
                                         <i class="fa fa-credit-card fa-5x"></i>
                                         <br>
                                         Punch Out
                                     </button>
                                   </div>

                                   <span style="color: #3A87AD;"><i class="fa fa-clock-o"></i></span> <b>Office Hour:</b>
                                   {{ date("g A", strtotime("$settings->office_hour_start:00")) }}
                                   -
                                   {{ date("g A", strtotime("$settings->office_hour_end:00")) }}

                                   <br>

                                   <span style="color: #3A87AD;"><i class="fa fa-calendar"></i></span>
                                   <b>Weekdays:</b>
                                   {{ $weekday_list[$settings->office_weekday_start] }}
                                   -
                                   {{ $weekday_list[$settings->office_weekday_end] }}
                               </div>
                           </div>
                       </div>
                       <!-- /block -->
                   </div>
                   <div class="span3">
                       <!-- block -->
                       <div class="block dashboard-box" >
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">This Month's Attendance Rate</div>
                               <div class="pull-right">

                                   <a class="label" href="{{ URL::to('/employee-panel/attendance-details') }}">Details</a>
                               </div>
                           </div>

                           <div class="block-content collapse in">
                               <div class="span12 dashboard-box2">
                                   <div id="attendance_rate_piechart" style="width:100%;height:200px" ></div>
                               </div>
                           </div>
                       </div>
                       <!-- /block -->
                   </div>
                   <div class="span3">
                       <!-- block -->
                       <div class="block dashboard-box">
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Today</div>
                               <div class="pull-right">
                                   <span id="refresh-weather-forecast" class="label label-inverse" style="cursor:pointer;"><i class="fa fa-refresh"></i></span>
                               </div>
                           </div>
                           <div class="block-content collapse in">
                               <div class="span12 dashboard-box2">
                                   <span id="weather-forecast">
                                       <div style="text-align: center !important; padding-top:30%">
                                           <i class="fa fa-spinner fa-pulse fa-3x"></i>
                                       </div>
                                   </span>
                               </div>
                           </div>
                       </div>
                       <!-- /block -->
                   </div>
               </div>

               <div class="row-fluid">
                   <div class="span6">
                       <!-- block -->
                       <div class="block dashboard-box" >
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Groups</div>

                           </div>
                           <div class="block-content collapse in">
                               <div class="span12 dashboard-box2">
                                   @if(count($group_list) > 0)
                                     <table class="table table-bordered">
                                      <thead>
   						                <tr>
   						                  <th>Name</th>
   						                  <th>Description</th>
   						                </tr>
   						              </thead>
                                     <tbody>

                                         @foreach($group_list as $key => $value)
                                           <tr>
                                             <td>{{ $value->name }}</td>                                                 <td>{{ $value->description }}</td>

                                           </tr>
                                         @endforeach

                                     </tbody>
                                   </table>
                                   @else
                                       <span>No groups found</span>
                                   @endif
                               </div>
                           </div>
                       </div>
                       <!-- /block -->
                   </div>

                   <div class="span3">
                       <!-- block -->
                       <div class="block dashboard-box">
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Recent Leave Status</div>
                               <div class="pull-right">
                                   <a class="label" href="{{ URL::to('/employee-panel/leave') }}">Details</a>
                                </div>
                           </div>
                           <div class="block-content collapse in">
                               <div class="span12 dashboard-box2">
                                   @if(count($leave_list) > 0)
                                     <table class="table table-bordered">
                                     <tbody>

                                         @foreach($leave_list as $key => $value)
                                           <tr>
                                             <td>{{ $value->type }}</td>
                                             <td class="vert-align">

                                                 @if($value->status == 1)
                                                      <i class="fa fa-check-square" style="color:green;"></i> Approved
                                                 @elseif($value->status == 2)
                                                      <i class="fa fa-times" style="color:red;"></i> Rejected
                                                 @else
                                                      <i class="fa fa-clock-o" style="color:orange;"></i> Pending
                                                 @endif
                                             </td>
                                           </tr>
                                         @endforeach

                                     </tbody>
                                   </table>
                                   @else
                                       <span>No pending requests found</span>
                                   @endif
                               </div>
                           </div>
                       </div>
                       <!-- /block -->
                   </div>
                   <div class="span3">
                       <!-- block -->
                       <div class="block dashboard-box">
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Recent Equipment Status</div>

                               <div class="pull-right">
                                   <a class="label" href="{{ URL::to('/employee-panel/equipments') }}">Details</a>
                               </div>
                           </div>
                           <div class="block-content collapse in">
                               <div class="span12 dashboard-box2">
                                   @if(count($equipment_list) > 0)
                                     <table class="table table-bordered">
                                     <tbody>

                                         @foreach($equipment_list as $key => $value)
                                           <tr>
                                             <td>{{ $value->name }}</td>
                                             <td class="vert-align">

                                                 @if($value->status == 1)
                                                      <i class="fa fa-check-square" style="color:green;"></i> Approved
                                                 @elseif($value->status == 2)
                                                      <i class="fa fa-times" style="color:red;"></i> Rejected
                                                 @else
                                                      <i class="fa fa-clock-o" style="color:orange;"></i> Pending
                                                 @endif
                                             </td>
                                           </tr>
                                         @endforeach

                                     </tbody>
                                   </table>
                                   @else
                                       <span>No pending requests found</span>
                                   @endif
                               </div>
                           </div>
                       </div>
                       <!-- /block -->
                   </div>
               </div>
            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    @include('layouts.js_scripts.employee_master')
    @include('layouts.js_scripts.charts')

    <!-- javascripts for graph -->
    <script>
        $(function() {
            showPieChart('#attendance_rate_piechart', {{ $json_output_emp_attendance }});

            //click to refresh showWeather
            $('#refresh-weather-forecast').click(function() {
                showWeather ();
            });

            //load weather-forecast when page loaded
            showWeather ();
        });


        //javascripts for weather-forecast
        function showWeather () {
            $("#weather-forecast").html('<div style="text-align: center !important; padding-top:30%;"><i class="fa fa-spinner fa-pulse fa-3x"></i></div>');
            $.ajax({
                type: "GET",
                url : "ajax/weather-forecast",
                processData: false,
                contentType: false,
                cache: false,
                success : function(data){
                    $("#weather-forecast").html(data);
                }

            },"json");
        }

    </script>
@stop
