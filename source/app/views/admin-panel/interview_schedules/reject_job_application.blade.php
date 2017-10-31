<!-- Page title -->
@section('title')
    Reject Job Application
@stop

<!-- Specefic  style sheet section for this page -->
@section('css_sheets')
    @include('layouts.css_sheets.form')
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
                            <div class="muted pull-left">Reject Job Application</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view  -->
                                {{ Form::open(array('url' => '/admin-panel/update-reject-job-application', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                    <div class="controls">
                                        <div class="pull-right">
                                            <span class="required-sign"></span><small><i>Required Fields</i></small>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                      {{ Form::label('job_title', 'Job Title', array('class' => 'control-label')) }}

                                      <div class="controls">

                                      {{ Form::text('job_title', $job->title, array('class'=>'input-xlarge focused', 'id'=>'job_title', 'disabled'=>'disabled')) }}
                                      </div>
                                    </div>

                                    <div class="control-group">
                                      {{ Form::label('applicant_name', 'Applicant Name', array('class' => 'control-label')) }}

                                      <div class="controls">

                                      {{ Form::text('applicant_name', $applicant->first_name.' '.$applicant->last_name, array('class'=>'input-xlarge focused', 'id'=>'applicant_name', 'disabled'=>'disabled')) }}
                                      </div>
                                    </div>


                                    <div class="control-group
                                    @if($errors->has('reason'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('reason', 'Reason', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::textarea('reason', Input::old('reason'), array('class'=>'input-xlarge focused', 'id'=>'reason')) }}

                                        <span class="help-block">
                                            @if($errors->has('reason'))
                                                {{ $errors->first('reason') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                    <div class="form-actions">
                                        {{ Form::hidden('interview_schedule_id', $interview_schedule->id) }}
                                        {{ Form::hidden('applicant_id', $interview_schedule->applicant_id) }}

                                        {{ Form::submit('Reject', array('class'=>'btn btn-danger btn-large'))}}

                                        <a class="btn" href="{{ URL::to('/admin-panel/interview-schedules') }}">Cancel</a>
                                    </div>

                                    </fieldset>
                                    {{ Form::close() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    @include('layouts.js_scripts.form')
@stop
