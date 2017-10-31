<!-- Page title -->
@section('title')
    Edit Job
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
                            <div class="muted pull-left">Edit Job</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view -->
                                {{ Form::model($job, array('route' => array('admin-panel.jobs.update', $job->id), 'method' => 'PUT', 'class'=>'form-horizontal', 'id'=>'job-form')) }}
                                <fieldset>

                                <legend>Job Details</legend>
                                <div class="control-group
                                @if($errors->has('title'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('title', 'Title', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('title',  Input::old('title'), array('class'=>'input-xlarge focused', 'id'=>'title', 'placeholder'=>'Sr. Software Engineer')) }}

                                    <span class="help-block">
                                        @if($errors->has('title'))
                                            {{ $errors->first('title') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('start_date'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('start_date', 'Start Date', array('class' => 'control-label')) }}
                                  <div class="controls">

                                      {{ Form::text('start_date', Input::old('start_date'), array('class'=>'input-xlarge form_date', 'id'=>'start_date', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}


                                    <span class="help-block">
                                        @if($errors->has('start_date'))
                                            {{ $errors->first('start_date') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('end_date'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('end_date', 'End Date', array('class' => 'control-label')) }}
                                  <div class="controls">

                                      {{ Form::text('end_date', Input::old('end_date'), array('class'=>'input-xlarge form_date', 'id'=>'end_date', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}

                                    <span class="help-block">
                                        @if($errors->has('end_date'))
                                            {{ $errors->first('end_date') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('salary_range'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('salary_range', 'Salary Range', array('class' => 'control-label')) }}
                                  <div class="controls">
                                      {{ Form::text('salary_range', Input::old('salary_range'), array('class'=>'input-xlarge focused', 'id'=>'salary_range', 'placeholder'=>'$1500 - $2000')) }}


                                    <span class="help-block">
                                        @if($errors->has('salary_range'))
                                            {{ $errors->first('salary_range') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('no_of_vacancies'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('no_of_vacancies', 'No. of Vacancies', array('class' => 'control-label')) }}
                                  <div class="controls">
                                      {{ Form::text('no_of_vacancies', Input::old('no_of_vacancies'), array('class'=>'input-xlarge focused', 'id'=>'no_of_vacancies', 'placeholder'=>'5')) }}


                                    <span class="help-block">
                                        @if($errors->has('no_of_vacancies'))
                                            {{ $errors->first('no_of_vacancies') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('job_nature'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('job_nature', 'Job Nature', array('class' => 'control-label')) }}
                                  <div class="controls">
                                      {{ Form::text('job_nature', Input::old('job_nature'), array('class'=>'input-xlarge focused', 'id'=>'job_nature', 'placeholder'=>'Full-time')) }}


                                    <span class="help-block">
                                        @if($errors->has('job_nature'))
                                            {{ $errors->first('job_nature') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('experience_requirements'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('experience_requirements', 'Experience Requirements', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('experience_requirements', Input::old('experience_requirements'), array('class'=>'input-xlarge focused', 'id'=>'experience_requirements', 'placeholder'=>'3 to 5 years' )) }}


                                    <span class="help-block">
                                        @if($errors->has('experience_requirements'))
                                            {{ $errors->first('experience_requirements') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('educational_requirements'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('educational_requirements', 'Educational Requirements', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('educational_requirements', Input::old('educational_requirements'), array('class'=>'input-xlarge focused', 'id'=>'educational_requirements', 'placeholder'=>"Bachelor's Degree in Computer Science" )) }}


                                    <span class="help-block">
                                        @if($errors->has('educational_requirements'))
                                            {{ $errors->first('educational_requirements') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('additional_requirements'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('additional_requirements', 'Additional Requirements', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::textarea('additional_requirements', Input::old('additional_requirements'), array('class'=>'input-xlarge textarea', 'id'=>'additional_requirements', 'style'=>'width: 75%', 'placeholder'=>"e.g.<ul><li>Age 25 to 45 years</li><li>Experience with HTML, CSS, LESS, Twitter Bootstrap</li></ul>" )) }}


                                    <span class="help-block">
                                        @if($errors->has('additional_requirements'))
                                            {{ $errors->first('additional_requirements') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('description'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('description', 'Description', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::textarea('description', Input::old('description'), array('class'=>'input-xlarge textarea', 'id'=>'description', 'style'=>'width: 75%', 'placeholder'=>"e.g.<ul><li>Age 25 to 45 years</li><li>Experience with HTML, CSS, LESS, Twitter Bootstrap</li></ul>" )) }}


                                    <span class="help-block">
                                        @if($errors->has('description'))
                                            {{ $errors->first('description') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('other_benefits'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('other_benefits', 'Other Benefits', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::textarea('other_benefits', Input::old('other_benefits'), array('class'=>'input-xlarge textarea', 'id'=>'other_benefits', 'style'=>'width: 75%', 'placeholder'=>"e.g.<ul><li>Life Insurance & Held allowance</li><li>Festival Bonus</li><li>Employees Gratuity</li></ul>" )) }}


                                    <span class="help-block">
                                        @if($errors->has('other_benefits'))
                                            {{ $errors->first('other_benefits') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="form-actions">
                                  {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large'))}}

                                  <a class="btn" href="{{ URL::to('/admin-panel/jobs') }}">Cancel</a>

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
