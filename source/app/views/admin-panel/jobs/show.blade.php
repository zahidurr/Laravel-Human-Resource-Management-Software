<!-- Page title -->
@section('title')
    Job
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
                           <div class="muted pull-left">Job Details</div>

                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <h3>{{ $job->title }}</h3>
                           </div>
                       </div>

                   </div>
                   <!-- /block -->
               </div>

               <div class="row-fluid">
                   <div class="span5">
                       <!-- block -->
                       <div class="block">

                           <div class="block-content collapse in">
                               <div class="span12">
                                   <p></p>
                                   <div class="span12"><span class="titleText">Published On:</span>
                                   {{ $job->start_date }}</div>

                                   <div class="span12"><span class="titleText">Application Deadline:</span>
                                       {{ $job->end_date }}</div>

                                   <div class="span12"><span class="titleText">No. of  Vacancies:</span>
                                   {{ $job->no_of_vacancies }}</div>

                                   <div class="span12"><span class="titleText">Job Nature:</span>
                                       {{ $job->job_nature }}</div>

                                   <div class="span12"><span class="titleText">Experience:</span>
                                       {{ $job->experience_requirements }}</div>

                                   <div class="span12"><span class="titleText">Salary Range:</span>
                                       {{ $job->salary_range }}</div>

                               </div>
                           </div>
                       </div>
                   </div>


                   <div class="span7">
                       <!-- block -->
                       <div class="block">
                           <div class="block-content collapse in">
                               <div class="span12">
                                   <span></span>
                                   <div class="span12">
                                       <h5>Educational Requirements</h5>
                                       {{ $job->educational_requirements }}
                                       <br><br>
                                   </div>

                                   <div class="span12">
                                       <h5>Additional Requirements</h5>
                                       {{ $job->additional_requirements }}
                                       <br>
                                   </div>

                                   <div class="span12">
                                       <h5>Job Description</h5>
                                       {{ $job->description }}
                                       <br>
                                   </div>


                                   <div class="span12">
                                       <h5>Other Benefits</h5>
                                       {{ $job->other_benefits }}
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
@stop
