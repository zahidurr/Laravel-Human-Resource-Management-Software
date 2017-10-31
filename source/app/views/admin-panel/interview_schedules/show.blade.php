<!-- Page title -->
@section('title')
    Interview Schedules Details
@stop

<!-- Specefic  style sheet section for this page -->
@section('css_sheets')
    {{ HTML::style('/vendors/easypiechart/jquery.easy-pie-chart.css') }}
@stop

<!-- Page content to add in master layout -->
@section('content')

    <!-- Top header bar of the page. See top_bar layouts -->
    @include('layouts.top_bar')

    <div class="container-fluid">
        <div class="row-fluid">

            <!-- Left menu for admin panel. See left_menu layouts -->
            @include('layouts.left_menu')

            <div class="span9" id="content">

                <div class="row-fluid">
                   <!-- block -->
                   <div class="block">

                       <!-- block header -->
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Interview Schedule Details</div>

                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">

                               <div class="row-fluid">
                                   <div class="pull-right">
                                       @if($interview_schedule->job_status == 1)
                                           <span class="label label-success" style="font-size: 150%; padding: 10px 15px 10px 15px;">
                                               <i class="fa fa-check"></i> Approved
                                           </span>
                                       @elseif($interview_schedule->job_status == 2)

                                            <span class="label label-important" style="font-size: 150%; padding: 10px 15px 10px 15px;">
                                                <i class="fa fa-times"></i> Rejected
                                            </span>

                                       @else
                                       <a href="{{ URL::to('/admin-panel/approve-job-application/'.$interview_schedule->id) }}" class="btn btn-success">
                                           <i class="icon-ok icon-white"></i> Approve
                                       </a>

                                       <a href="{{ URL::to('/admin-panel/reject-job-application/'.$interview_schedule->id) }}" class="btn btn-danger">
                                           <i class="icon-remove icon-white"></i> Reject
                                       </a>


                                        @endif
                                   </div>
                                   <div class="pull-left">
                                       <span class="titleText">Interview Date:</span>
                                       {{ date("j-M-Y, h:i A", strtotime($interview_schedule->interview_date)) }}

                                       <br>
                                       <span class="titleText">Total Board Members:</span>
                                       {{ count($board_members) }}


                                   </div>

                               </div>
                           </div>
                       </div>

                   </div>
                   <!-- /block -->
               </div>

               <div class="row-fluid">
                   <div class="span6">
                       <!-- block -->
                       <div class="block" style="height: 240px;">
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Job Summary</div>

                           </div>
                           <div class="block-content collapse in">
                               <div class="span12">

                                   <a href="{{ URL::to('/admin-panel/jobs/'. $job->id) }}">
                                       <h4>{{ $job->title }}</h4>
                                   </a>

                                   <span class="titleText">Published On:</span>
                                   {{ date("j-M-Y", strtotime($job->start_date)) }}
                                   <br>

                                   <span class="titleText">Application Deadline:</span>
                                       {{ date("j-M-Y", strtotime($job->end_date)) }}
                                   <br>

                                   <span class="titleText">No. of  Vacancies:</span>
                                   {{ $job->no_of_vacancies }}
                                   <br>

                                   <span class="titleText">Job Nature:</span>
                                       {{ $job->job_nature }}
                                       <br>

                                   <span class="titleText">Experience:</span>
                                       {{ $job->experience_requirements }}
                                       <br>

                                   <span class="titleText">Salary Range:</span>
                                       {{ $job->salary_range }}

                               </div>
                           </div>
                       </div>
                   </div>


                   <div class="span6">
                       <!-- block -->
                       <div class="block" style="height: 240px;">
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left">Applicant Summary</div>
                           </div>
                           <div class="block-content collapse in">


                                   <h4>
                                       <img src="{{ asset('/uploads/images/'.$applicant->profile_image) }}"  class="profile-image-small" />


                                       <a href="{{ URL::to('/admin-panel/applicants/'. $applicant->user_id) }}">
                                       {{ $applicant->first_name }} {{ $applicant->last_name }}
                                        </a>
                                   </h4>


                                   <span class="titleText">Date of Birth:</span>
                                   {{ date("j-M-Y", strtotime($applicant->dob)) }}
                                   <br>

                                   <span class="titleText">Gender:</span>

                                   {{ App::make('UtilController')->genderName ($applicant->gender) }}
                                   <br>

                                   <span class="titleText">Marital Status:</span>

                                   {{ App::make('UtilController')->maritalStatusName ($applicant->marital_status) }}
                                   <br>


                                   <span class="titleText">Phone:</span>
                                   {{ $applicant->phone }}
                                   <br>

                                   <span class="titleText">Address:</span>
                                   {{ $applicant->address }}



                           </div>
                       </div>
                   </div>
               </div>

               <div class="row-fluid">
                   <!-- block -->
                   <div class="block">
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Interview Statistics</div>



                       </div>
                       <div class="block-content collapse in">
                           <div class="span4">
                               <div class="chart" data-percent="{{ round(($applicant_selected_count/count($board_members)) * 100) }}">{{ round(($applicant_selected_count/count($board_members)) * 100) }}%</div>
                               <div class="chart-bottom-heading"><span class="label label-info">Applicant Selection</span>

                               </div>
                           </div>
                           <div class="span4">
                               <div class="chart" data-percent="{{ round(($job_accepted_count/count($board_members)) * 100) }}">{{ round(($job_accepted_count/count($board_members)) * 100) }}%</div>
                               <div class="chart-bottom-heading"><span class="label label-info">Qualified for Job</span>

                               </div>
                           </div>
                           <div class="span4">
                               <div class="chart" data-percent="{{ round($total_marks/count($board_members)) }}">{{ round($total_marks/count($board_members)) }}%</div>
                               <div class="chart-bottom-heading"><span class="label label-info">Average Interview Marks</span>

                               </div>
                           </div>

                       </div>
                   </div>
                   <!-- /block -->
               </div>

               <div class="row-fluid">
                   <!-- block -->
                   <div class="block">
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Interview Board Feedback</div>

                       </div>
                       <div class="block-content collapse in">
                           <div class="span12">
                                 <table class="table table-bordered">
                                 <thead>
                                   <tr>
                                     <th>Board Member Name</th>
                                     <th>Applicant Selected</th>
                                     <th>Qualified for Job</th>
                                     <th>Interview Marks</th>
                                     <th>Comment</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                       @foreach($board_members as $value)
                                       <tr>
                                         <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                         <td class="text-center">
                                             @if($value->selected == 1)
                                                <span style="color:green;"><i class="fa fa-check"></i></span>
                                             @else
                                                <span style="color:red;"><i class="fa fa-times"></i></span>
                                            @endif
                                         </td>
                                         <td class="text-center">
                                             @if($value->accepted == 1)
                                                <span style="color:green;"><i class="fa fa-check"></i></span>
                                             @else
                                                <span style="color:red;"><i class="fa fa-times"></i></span>
                                            @endif
                                         </td>
                                         <td class="text-center">{{ $value->marks }}</td>
                                         <td>{{ $value->comment }}</td>

                                       </tr>
                                       @endforeach
                                 </tbody>
                               </table>
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
    {{ HTML::script('/vendors/easypiechart/jquery.easy-pie-chart.js') }}

    <script>
    $(function() {
        // Easy pie charts
        $('.chart').easyPieChart({animate: 1000});
    });
    </script>
@stop
