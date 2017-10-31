<!-- Page title -->
@section('title')
    Approve Job Application
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
                            <div class="muted pull-left">Approve Job Application</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view  -->
                                {{ Form::open(array('url' => '/admin-panel/update-approve-job-application', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                    <legend>Job Application Summary</legend>

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

                                    <legend>Employee Information</legend>
                                    <div class="pull-right">
                                        <span class="required-sign"></span><small><i>Required Fields</i></small>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('department_id'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('department_id', 'Department', array('class' => 'control-label required')) }}
                                      <div class="controls">

                                          {{ Form::select('department_id', $department_list, Input::old('department_id'), array('class' => 'form-control')) }}

                                          <span class="help-block">
                                              @if($errors->has('department_id'))
                                                  {{ $errors->first('department_id') }}
                                              @endif
                                          </span>

                                      </div>
                                    </div>
                                    <div class="control-group
                                    @if($errors->has('designation'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('designation', 'Designation', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::text('designation', Input::old('designation'), array('class'=>'input-xlarge focused', 'id'=>'designation')) }}



                                        <span class="help-block">
                                            @if($errors->has('designation'))
                                                {{ $errors->first('designation') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="control-group
                                    @if($errors->has('employee_id'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('employee_id', 'Employee ID', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::text('employee_id', Input::old('employee_id'), array('class'=>'input-xlarge focused', 'id'=>'employee_id')) }}



                                        <span class="help-block">
                                            @if($errors->has('employee_id'))
                                                {{ $errors->first('employee_id') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('joining_date'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('joining_date', 'Joining Date', array('class' => 'control-label required')) }}
                                      <div class="controls">

                                          {{ Form::text('joining_date', Input::old('joining_date'), array('class'=>'input-xlarge form_date', 'id'=>'joining_date', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}


                                        <span class="help-block">
                                            @if($errors->has('joining_date'))
                                                {{ $errors->first('joining_date') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <legend>Account Access</legend>
                                    <div class="control-group
                                    @if($errors->has('email'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('email', 'Email', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::text('email', Input::old('email'), array('class'=>'input-xlarge focused', 'id'=>'email')) }}



                                        <span class="help-block">
                                            @if($errors->has('email'))
                                                {{ $errors->first('email') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('password'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('password', 'Password', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::password('password', '', array('class'=>'input-xlarge focused', 'id'=>'password')) }}

                                        <span class="help-block">
                                            @if($errors->has('password'))
                                                {{ $errors->first('password') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                    <div class="form-actions">
                                        {{ Form::hidden('interview_schedule_id', $interview_schedule->id) }}
                                        {{ Form::hidden('applicant_id', $interview_schedule->applicant_id) }}

                                        {{ Form::submit('Approve & Register', array('class'=>'btn btn-danger btn-large'))}}

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
