<!-- Page title -->
@section('title')
    Edit Employee Résumé
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
                            <div class="muted pull-left">Edit Employee Résumé</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- tab buttons -->
                                <ul class="nav nav-tabs" role="tablist" id="usersTab">
                                   <li role="presentation" class="active"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Personal</a></li>

                                   <li role="presentation"><a href="#education-training" aria-controls="education-training" role="tab" data-toggle="tab">Education/Training</a></li>

                                   <li role="presentation"><a href="#employment" aria-controls="employment" role="tab" data-toggle="tab">Employment/Experience</a></li>

                                   <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">Other</a></li>

                                   <li role="presentation"><a href="#photograph" aria-controls="photograph" role="tab" data-toggle="tab">Photograph</a></li>
                               </ul>

                               <!-- Form view -->
                                {{ Form::model($employee, array('route' => array('admin-panel.employees.update', $employee->id), 'method' => 'PUT', 'class'=>'form-horizontal', 'id'=>'user-form')) }}

                                <fieldset>
                                    <div class="tab-content">
                                      <div role="tabpanel" class="tab-pane fade in active" id="personal">

                                      <div class="pull-right">
                                          <span class="required-sign"></span><small><i>Required Fields</i></small>
                                      </div>

                                    <legend>
                                        Personal Information
                                    </legend>

                                    <div class="control-group
                                    @if($errors->has('first_name'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('first_name', 'First Name', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::text('first_name', Input::old('first_name'), array('class'=>'input-xlarge focused', 'id'=>'first_name')) }}



                                        <span class="help-block">
                                            @if($errors->has('first_name'))
                                                {{ $errors->first('first_name') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                    <div class="control-group
                                    @if($errors->has('last_name'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('last_name', 'Last Name', array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('last_name', Input::old('last_name'), array('class'=>'input-xlarge focused', 'id'=>'last_name')) }}


                                        <span class="help-block">
                                            @if($errors->has('last_name'))
                                                {{ $errors->first('last_name') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('father_name'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('father_name', "Father's Name", array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('father_name', Input::old('father_name'), array('class'=>'input-xlarge focused', 'id'=>'father_name')) }}


                                        <span class="help-block">
                                            @if($errors->has('father_name'))
                                                {{ $errors->first('father_name') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('mother_name'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('mother_name', "Mother's Name", array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('mother_name', Input::old('mother_name'), array('class'=>'input-xlarge focused', 'id'=>'mother_name')) }}


                                        <span class="help-block">
                                            @if($errors->has('mother_name'))
                                                {{ $errors->first('mother_name') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('dob'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('dob', 'Date of Birth', array('class' => 'control-label required')) }}
                                      <div class="controls">

                                          {{ Form::text('dob', Input::old('dob'), array('class'=>'input-xlarge form_date', 'id'=>'dob', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}


                                        <span class="help-block">
                                            @if($errors->has('dob'))
                                                {{ $errors->first('dob') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>



                                    <div class="control-group
                                    @if($errors->has('gender'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('gender', 'Gender', array('class' => 'control-label required')) }}
                                      <div class="controls">

                                      {{ Form::select('gender', $gender_list, Input::old('gender'), array('class' => 'form-control')) }}
                                      <span class="help-block">
                                          @if($errors->has('gender'))
                                              {{ $errors->first('gender') }}
                                          @endif
                                      </span>

                                      </div>
                                    </div>
                                    <div class="control-group
                                    @if($errors->has('marital_status'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('marital_status', 'Marital Status', array('class' => 'control-label required')) }}
                                      <div class="controls">

                                          {{ Form::select('marital_status', $maritalstatus_list, Input::old('marital_status'), array('class' => 'form-control')) }}

                                          <span class="help-block">
                                              @if($errors->has('marital_status'))
                                                  {{ $errors->first('marital_status') }}
                                              @endif
                                          </span>

                                      </div>
                                    </div>


                                    <div class="control-group
                                    @if($errors->has('ssn'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('ssn', 'SSN / ID No.', array('class' => 'control-label')) }}
                                      <div class="controls">
                                      {{ Form::text('ssn', Input::old('ssn'), array('class'=>'input-xlarge focused', 'id'=>'ssn')) }}


                                        <span class="help-block">
                                            @if($errors->has('ssn'))
                                                {{ $errors->first('ssn') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('nationality'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('nationality', 'Nationality', array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('nationality', Input::old('nationality'), array('class'=>'input-xlarge focused', 'id'=>'nationality')) }}


                                        <span class="help-block">
                                            @if($errors->has('nationality'))
                                                {{ $errors->first('nationality') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>



                                    <div class="control-group
                                    @if($errors->has('religion'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('religion', 'Religion', array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('religion', Input::old('religion'), array('class'=>'input-xlarge focused', 'id'=>'religion')) }}


                                        <span class="help-block">
                                            @if($errors->has('religion'))
                                                {{ $errors->first('religion') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                <legend>Contact Information</legend>
                                <div class="control-group
                                @if($errors->has('main_email'))
                                    error
                                @endif
                                ">

                                    {{ Form::label('main_email', 'Email', array('class' => 'control-label required')) }}
                                  <div class="controls">
                                  {{ Form::text('main_email', Input::old('main_email'), array('class'=>'input-xlarge focused', 'id'=>'main_email')) }}

                                    <span class="help-block">
                                        @if($errors->has('main_email'))
                                            {{ $errors->first('main_email') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>
                                <div class="control-group
                                @if($errors->has('alternative_email'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('alternative_email', 'Alternative Email', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('alternative_email', Input::old('alternative_email'), array('class'=>'input-xlarge focused', 'id'=>'alternative_email')) }}


                                    <span class="help-block">
                                        @if($errors->has('alternative_email'))
                                            {{ $errors->first('alternative_email') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>
                                    <div class="control-group
                                    @if($errors->has('phone'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('phone', 'Phone', array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('phone', Input::old('phone'), array('class'=>'input-xlarge focused', 'id'=>'phone')) }}


                                        <span class="help-block">
                                            @if($errors->has('phone'))
                                                {{ $errors->first('phone') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('alternative_phone'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('alternative_phone', 'Alternative Phone', array('class' => 'control-label')) }}
                                      <div class="controls">
                                      {{ Form::text('alternative_phone', Input::old('alternative_phone'), array('class'=>'input-xlarge focused', 'id'=>'alternative_phone')) }}


                                        <span class="help-block">
                                            @if($errors->has('alternative_phone'))
                                                {{ $errors->first('alternative_phone') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                    <div class="control-group
                                    @if($errors->has('address'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('address', 'Address', array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::textarea('address', Input::old('address'), array('class'=>'input-xlarge focused', 'id'=>'address')) }}


                                        <span class="help-block">
                                            @if($errors->has('address'))
                                                {{ $errors->first('address') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <legend>
                                        Employee Information
                                    </legend>
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


                                    </div>
                                    <!-- education-training tab panel -->
                                    <div role="tabpanel" class="tab-pane fade" id="education-training">

                                        <legend>Academic Qualification</legend>
                                        <div class="control-group
                                        @if($errors->has('level_of_education'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('level_of_education', 'Level of Education', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('level_of_education', Input::old('level_of_education'), array('class'=>'input-xlarge focused', 'id'=>'level_of_education')) }}


                                            <span class="help-block">
                                                @if($errors->has('level_of_education'))
                                                    {{ $errors->first('level_of_education') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('exam_or_degree_title'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('exam_or_degree_title', 'Exam/Degree Title', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('exam_or_degree_title', Input::old('exam_or_degree_title'), array('class'=>'input-xlarge focused', 'id'=>'exam_or_degree_title')) }}


                                            <span class="help-block">
                                                @if($errors->has('exam_or_degree_title'))
                                                    {{ $errors->first('exam_or_degree_title') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('concentration_or_major_or_group'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('concentration_or_major_or_group', 'Concentration/Major/Group', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('concentration_or_major_or_group', Input::old('concentration_or_major_or_group'), array('class'=>'input-xlarge focused', 'id'=>'concentration_or_major_or_group')) }}


                                            <span class="help-block">
                                                @if($errors->has('concentration_or_major_or_group'))
                                                    {{ $errors->first('concentration_or_major_or_group') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('institute_name'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('institute_name', 'Institute Name', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('institute_name', Input::old('institute_name'), array('class'=>'input-xlarge focused', 'id'=>'institute_name')) }}


                                            <span class="help-block">
                                                @if($errors->has('institute_name'))
                                                    {{ $errors->first('institute_name') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('result'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('result', 'Result', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('result', Input::old('result'), array('class'=>'input-xlarge focused', 'id'=>'result')) }}


                                            <span class="help-block">
                                                @if($errors->has('result'))
                                                    {{ $errors->first('result') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('year_of_passing'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('year_of_passing', 'Year of Passing', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('year_of_passing', Input::old('year_of_passing'), array('class'=>'input-xlarge focused', 'id'=>'year_of_passing')) }}


                                            <span class="help-block">
                                                @if($errors->has('year_of_passing'))
                                                    {{ $errors->first('year_of_passing') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('achievement'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('achievement', 'Achievement', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('achievement', Input::old('achievement'), array('class'=>'input-xlarge focused', 'id'=>'achievement')) }}


                                            <span class="help-block">
                                                @if($errors->has('achievement'))
                                                    {{ $errors->first('achievement') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <legend>Training Summary</legend>
                                        <div class="control-group
                                        @if($errors->has('training_title'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('training_title', 'Training Title', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('training_title', Input::old('training_title'), array('class'=>'input-xlarge focused', 'id'=>'training_title')) }}


                                            <span class="help-block">
                                                @if($errors->has('training_title'))
                                                    {{ $errors->first('training_title') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ts_institute'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ts_institute', 'Institute Name', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ts_institute', Input::old('ts_institute'), array('class'=>'input-xlarge focused', 'id'=>'ts_institute')) }}


                                            <span class="help-block">
                                                @if($errors->has('ts_institute'))
                                                    {{ $errors->first('ts_institute') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ts_location'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ts_location', 'Location', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ts_location', Input::old('ts_location'), array('class'=>'input-xlarge focused', 'id'=>'ts_location')) }}


                                            <span class="help-block">
                                                @if($errors->has('ts_location'))
                                                    {{ $errors->first('ts_location') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('training_year'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('training_year', 'Training Year', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('training_year', Input::old('training_year'), array('class'=>'input-xlarge focused', 'id'=>'training_year')) }}


                                            <span class="help-block">
                                                @if($errors->has('training_year'))
                                                    {{ $errors->first('training_year') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <legend>Professional Qualifications</legend>
                                        <div class="control-group
                                        @if($errors->has('certification'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('certification', 'Certification', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('certification', Input::old('certification'), array('class'=>'input-xlarge focused', 'id'=>'certification')) }}


                                            <span class="help-block">
                                                @if($errors->has('certification'))
                                                    {{ $errors->first('certification') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('pq_institute'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('pq_institute', 'Institute Name', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('pq_institute', Input::old('pq_institute'), array('class'=>'input-xlarge focused', 'id'=>'pq_institute')) }}


                                            <span class="help-block">
                                                @if($errors->has('pq_institute'))
                                                    {{ $errors->first('pq_institute') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('pq_location'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('pq_location', 'Location', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('pq_location', Input::old('pq_location'), array('class'=>'input-xlarge focused', 'id'=>'pq_location')) }}


                                            <span class="help-block">
                                                @if($errors->has('pq_location'))
                                                    {{ $errors->first('pq_location') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('pq_from'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('pq_from', 'From', array('class' => 'control-label')) }}
                                          <div class="controls">

                                          {{ Form::text('pq_from', Input::old('pq_from'), array('class'=>'input-xlarge form_date', 'id'=>'pq_from', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}

                                            <span class="help-block">
                                                @if($errors->has('pq_from'))
                                                    {{ $errors->first('pq_from') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('pq_to'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('pq_to', 'To', array('class' => 'control-label')) }}
                                          <div class="controls">

                                          {{ Form::text('pq_to', Input::old('pq_to'), array('class'=>'input-xlarge form_date', 'id'=>'pq_to', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}

                                            <span class="help-block">
                                                @if($errors->has('pq_to'))
                                                    {{ $errors->first('pq_to') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>
                                    </div>

                                    <!-- employment tab panel -->
                                    <div role="tabpanel" class="tab-pane fade" id="employment">
                                        <legend>Employment History</legend>

                                        <div class="control-group
                                        @if($errors->has('company_name'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('company_name', 'Company Name', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('company_name', Input::old('company_name'), array('class'=>'input-xlarge focused', 'id'=>'company_name')) }}


                                            <span class="help-block">
                                                @if($errors->has('company_name'))
                                                    {{ $errors->first('company_name') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('company_location'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('company_location', 'Company Location', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('company_location', Input::old('company_location'), array('class'=>'input-xlarge focused', 'id'=>'company_location')) }}


                                            <span class="help-block">
                                                @if($errors->has('company_location'))
                                                    {{ $errors->first('company_location') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('position_held'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('position_held', 'Position Held', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('position_held', Input::old('position_held'), array('class'=>'input-xlarge focused', 'id'=>'position_held')) }}


                                            <span class="help-block">
                                                @if($errors->has('position_held'))
                                                    {{ $errors->first('position_held') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('eh_department'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('eh_department', 'Department', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('eh_department', Input::old('eh_department'), array('class'=>'input-xlarge focused', 'id'=>'eh_department')) }}


                                            <span class="help-block">
                                                @if($errors->has('eh_department'))
                                                    {{ $errors->first('eh_department') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('eh_responsibilities'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('eh_responsibilities', 'Responsibilities', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('eh_responsibilities', Input::old('eh_responsibilities'), array('class'=>'input-xlarge focused', 'id'=>'eh_responsibilities')) }}


                                            <span class="help-block">
                                                @if($errors->has('eh_responsibilities'))
                                                    {{ $errors->first('eh_responsibilities') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('eh_from'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('eh_from', 'From', array('class' => 'control-label')) }}
                                          <div class="controls">


                                          {{ Form::text('eh_from', Input::old('eh_from'), array('class'=>'input-xlarge form_date', 'id'=>'eh_from', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}


                                            <span class="help-block">
                                                @if($errors->has('eh_from'))
                                                    {{ $errors->first('eh_from') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('eh_to'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('eh_to', 'To', array('class' => 'control-label')) }}
                                          <div class="controls">
                                              {{ Form::text('eh_to', Input::old('eh_to'), array('class'=>'input-xlarge form_date', 'id'=>'eh_to', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}


                                            <span class="help-block">
                                                @if($errors->has('eh_to'))
                                                    {{ $errors->first('eh_to') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <legend>Area of Experiences</legend>
                                        <div class="control-group
                                        @if($errors->has('experience_category'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('experience_category', 'Category', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('experience_category', Input::old('experience_category'), array('class'=>'input-xlarge focused', 'id'=>'experience_category')) }}


                                            <span class="help-block">
                                                @if($errors->has('experience_category'))
                                                    {{ $errors->first('experience_category') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('skills'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('skills', 'Skills', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('skills', Input::old('skills'), array('class'=>'input-xlarge focused', 'id'=>'skills')) }}


                                            <span class="help-block">
                                                @if($errors->has('skills'))
                                                    {{ $errors->first('skills') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>
                                    </div>

                                    <!-- other tab panel -->
                                    <div role="tabpanel" class="tab-pane fade" id="other">
                                        <legend>Reference</legend>
                                        <div class="control-group
                                        @if($errors->has('ref_name'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ref_name', 'Name', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ref_name', Input::old('ref_name'), array('class'=>'input-xlarge focused', 'id'=>'ref_name')) }}


                                            <span class="help-block">
                                                @if($errors->has('ref_name'))
                                                    {{ $errors->first('ref_name') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ref_organization'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ref_organization', 'Organization', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ref_organization', Input::old('ref_organization'), array('class'=>'input-xlarge focused', 'id'=>'ref_organization')) }}


                                            <span class="help-block">
                                                @if($errors->has('ref_organization'))
                                                    {{ $errors->first('ref_organization') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ref_designation'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ref_designation', 'Designation', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ref_designation', Input::old('ref_designation'), array('class'=>'input-xlarge focused', 'id'=>'ref_designation')) }}


                                            <span class="help-block">
                                                @if($errors->has('ref_designation'))
                                                    {{ $errors->first('ref_designation') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ref_address'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ref_address', 'Address', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ref_address', Input::old('ref_address'), array('class'=>'input-xlarge focused', 'id'=>'ref_address')) }}


                                            <span class="help-block">
                                                @if($errors->has('ref_address'))
                                                    {{ $errors->first('ref_address') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ref_phone'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ref_phone', 'Phone', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ref_phone', Input::old('ref_phone'), array('class'=>'input-xlarge focused', 'id'=>'ref_phone')) }}


                                            <span class="help-block">
                                                @if($errors->has('ref_phone'))
                                                    {{ $errors->first('ref_phone') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ref_email'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ref_email', 'Email', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ref_email', Input::old('ref_email'), array('class'=>'input-xlarge focused', 'id'=>'ref_email')) }}


                                            <span class="help-block">
                                                @if($errors->has('ref_email'))
                                                    {{ $errors->first('ref_email') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('ref_relation'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('ref_relation', 'Relation', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::text('ref_relation', Input::old('ref_relation'), array('class'=>'input-xlarge focused', 'id'=>'ref_relation')) }}


                                            <span class="help-block">
                                                @if($errors->has('ref_relation'))
                                                    {{ $errors->first('ref_relation') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>


                                        <legend>Career and Application Information</legend>

                                        <div class="control-group
                                        @if($errors->has('objective'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('objective', 'Objective', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::textarea('objective', Input::old('objective'), array('class'=>'input-xlarge focused', 'id'=>'objective')) }}


                                            <span class="help-block">
                                                @if($errors->has('objective'))
                                                    {{ $errors->first('objective') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('career_summary'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('career_summary', 'Career Summary', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::textarea('career_summary', Input::old('career_summary'), array('class'=>'input-xlarge focused', 'id'=>'career_summary')) }}


                                            <span class="help-block">
                                                @if($errors->has('career_summary'))
                                                    {{ $errors->first('career_summary') }}
                                                @endif
                                            </span>
                                          </div>
                                        </div>

                                        <div class="control-group
                                        @if($errors->has('spacial_qualification'))
                                            error
                                        @endif
                                        ">

                                          {{ Form::label('spacial_qualification', 'Spacial Qualification', array('class' => 'control-label')) }}
                                          <div class="controls">
                                          {{ Form::textarea('spacial_qualification', Input::old('spacial_qualification'), array('class'=>'input-xlarge focused', 'id'=>'spacial_qualification')) }}


                                            <span class="help-block">
                                                @if($errors->has('spacial_qualification'))
                                                    {{ $errors->first('spacial_qualification') }}
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- photograph tab panel -->
                                    <div role="tabpanel" class="tab-pane fade" id="photograph">
                                        <div class="control-group">
                                          <div class="controls">
                                              {{ Form::file('image', array('onchange' => "uploadImage(this, 'Employee', $employee->id);")) }}

                                              <a tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="<i class='fa fa-asterisk'></i> File must be less then 1MB in size<br><i class='fa fa-asterisk'></i> File must be in JPEG(.jpg or .jpeg) or PNG(.png) format"><i class="fa fa-info-circle"></i></a>
                                            <span class="help-block">
                                                <div id="upload-image-msg" ></div>
                                            </span>

                                            <br>
                                            <img src="{{ asset('uploads/images/'.$employee->profile_image) }}" id="image-preview" />

                                          </div>
                                        </div>
                                    </div>
                                    </div>


                                    <div class="form-actions">

                                      {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large'))}}
                                      <a class="btn" href="{{ URL::to('/admin-panel/employees') }}">Cancel</a>

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
