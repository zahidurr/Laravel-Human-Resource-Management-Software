<!-- Page title -->
@section('title')
    Create New Leave Request
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
            <div class="span12" id="content">

                <div class="row-fluid">
                    <!-- block -->
                    <div class="block">

                        <!-- block header -->
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Create New Leave Request</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">
                                <!-- Form view  -->
                                {{ Form::open(array('url' => '/employee-panel/leave', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                <div class="control-group
                                @if($errors->has('type'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('type', 'Leave Type', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('type',  Input::old('type'), array('class'=>'input-xlarge focused', 'id'=>'type', 'placeholder'=>'Medical')) }}

                                    <span class="help-block">
                                        @if($errors->has('type'))
                                            {{ $errors->first('type') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('from_date'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('from_date', 'From Date', array('class' => 'control-label')) }}
                                  <div class="controls">

                                      {{ Form::text('from_date', Input::old('from_date'), array('class'=>'input-xlarge form_date', 'id'=>'from_date', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}

                                    <span class="help-block">
                                        @if($errors->has('from_date'))
                                            {{ $errors->first('from_date') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('to_date'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('to_date', 'To Date', array('class' => 'control-label')) }}
                                  <div class="controls">

                                      {{ Form::text('to_date', Input::old('to_date'), array('class'=>'input-xlarge form_date', 'id'=>'to_date', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'YYYY-MM-DD')) }}


                                    <span class="help-block">
                                        @if($errors->has('to_date'))
                                            {{ $errors->first('to_date') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('reason'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('reason', 'Reason', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::textarea('reason',  Input::old('reason'), array('class'=>'input-xlarge focused', 'id'=>'reason', 'placeholder'=>'Medical treatment...')) }}

                                    <span class="help-block">
                                        @if($errors->has('reason'))
                                            {{ $errors->first('reason') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="form-actions">
                                    {{ Form::hidden('employee_id', Auth::user()->id) }}

                                  {{ Form::submit('Create', array('class'=>'btn btn-danger btn-large'))}}

                                  <a class="btn" href="{{ URL::to('/employee-panel/leave') }}">Cancel</a>

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
    @include('layouts.js_scripts.form_employee')
    @include('layouts.js_scripts.employee_master')
@stop
