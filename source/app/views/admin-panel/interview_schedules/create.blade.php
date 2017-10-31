<!-- Page title -->
@section('title')
    Create Interview Schedule
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
                            <div class="muted pull-left">Create Interview Schedule</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view  -->
                                {{ Form::open(array('url' => '/admin-panel/interview-schedules', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                    <div class="control-group
                                    @if($errors->has('job'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('job', 'Job', array('class' => 'control-label')) }}
                                      <div class="controls">

                                      {{ Form::select('job', $jobs, Input::old('job'), array('id' => 'job', 'class' => 'chzn-select')) }}


                                        <span class="help-block">
                                            @if($errors->has('job'))
                                                {{ $errors->first('job') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('applicant'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('applicant', 'Applicant', array('class' => 'control-label')) }}
                                      <div class="controls">

                                      {{ Form::select('applicant', $applicants, Input::old('applicant'), array('id' => 'job', 'class' => 'chzn-select')) }}


                                        <span class="help-block">
                                            @if($errors->has('applicant'))
                                                {{ $errors->first('applicant') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('interview_schedule'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('interview_schedule', 'Interview Date', array('class' => 'control-label')) }}
                                      <div class="controls">
                                          {{ Form::text('interview_schedule', Input::old('interview_schedule'), array('class'=>'input-xlarge form_datetime', 'id'=>'interview_schedule', 'data-date-format'=>'yyyy-mm-dd hh:ii', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD HH:MM')) }}

                                        <span class="help-block">
                                            @if($errors->has('interview_schedule'))
                                                {{ $errors->first('interview_schedule') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('board_members'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('board_members', 'Board Members', array('class' => 'control-label')) }}
                                      <div class="controls">

                                      {{ Form::select('board_members', $board_members, Input::old('board_members'), array( 'multiple' => 'multiple', 'id' => 'board_members', 'name' => 'board_members[]', 'class' => 'chzn-select')) }}


                                        <span class="help-block">
                                            @if($errors->has('board_members'))
                                                {{ $errors->first('board_members') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                    <div class="form-actions">

                                      {{ Form::submit('Assign', array('class'=>'btn btn-danger btn-large'))}}

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
