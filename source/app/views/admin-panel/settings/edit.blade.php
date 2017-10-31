<!-- Page title -->
@section('title')
    Settings
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

                    <!-- Display flash message here -->
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-check-circle"></i> {{ Session::get('success_message') }}

                    </div>
                    @endif

                    <!-- block -->
                    <div class="block">

                        <!-- block header -->
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Settings</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view -->
                                {{ Form::open(array('url' => 'admin-panel/update-settings', 'class'=>'form-horizontal')) }}

                                <fieldset>

                                <legend>
                                    Office Time
                                </legend>
                                <div class="control-group
                                @if($errors->has('office_hour_end'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('office_hour_start', 'Office Hour', array('class' => 'control-label')) }}
                                  <div class="controls">

                                  {{ Form::select('office_hour_start', $time_list, $settings->office_hour_start, array('style' => 'width: 100px;')) }}
                                  to
                                  {{ Form::select('office_hour_end', $time_list, $settings->office_hour_end, array('style' => 'width: 100px;')) }}

                                  <span class="help-block">
                                      @if($errors->has('office_hour_end'))
                                          {{ $errors->first('office_hour_end') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('office_weekday_end'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('office_weekday_start', 'Office Weekdays', array('class' => 'control-label')) }}
                                  <div class="controls">

                                  {{ Form::select('office_weekday_start', $weekday_list, $settings->office_weekday_start, array('style' => 'width: 130px;')) }}
                                  to
                                  {{ Form::select('office_weekday_end', $weekday_list, $settings->office_weekday_end, array('style' => 'width: 130px;')) }}

                                  <span class="help-block">
                                      @if($errors->has('office_weekday_end'))
                                          {{ $errors->first('office_weekday_end') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>


                                <legend>
                                    Employee Attendance Validation
                                </legend>

                                <div class="control-group
                                @if($errors->has('ip_range'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('ip_range', 'IP Range', array('class' => 'control-label')) }}

                                  <div class="controls">

                                  {{ Form::text('ip_range', $settings->ip_range, array('class'=>'input-xlarge focused', 'id'=>'ip_range', 'placeholder'=>'localhost')) }}

                                  <a tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="e.g. <br> 192.168.0.23<br> 192.168.0.*<br> 192.168.*.*<br> 192.*.*.* <br><br>localhost (To allow all IP range)"><i class="fa fa-info-circle"></i></a>

                                    <span class="help-block">
                                        @if($errors->has('ip_range'))
                                            {{ $errors->first('ip_range') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <legend>
                                    Weather Forecast
                                </legend>

                                <div class="control-group
                                @if($errors->has('weather_zip'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('weather_zip', 'Zip code or Location ID', array('class' => 'control-label')) }}

                                  <div class="controls">

                                  {{ Form::text('weather_zip', $settings->weather_zip, array('class'=>'input-xlarge focused', 'id'=>'weather_zip', 'placeholder'=>'94089')) }}



                                    <span class="help-block">
                                        @if($errors->has('weather_zip'))
                                            {{ $errors->first('weather_zip') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('temperature_units'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('temperature_units', 'Temperature Units', array('class' => 'control-label')) }}
                                  <div class="controls">

                                      {{ Form::select('temperature_units', $temperature_units, $settings->temperature_units, array('style' => 'width: 150px;')) }}

                                      <span class="help-block">
                                          @if($errors->has('temperature_units'))
                                              {{ $errors->first('temperature_units') }}
                                          @endif
                                      </span>
                                  </div>
                                </div>


                                <div class="form-actions">

                                  {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large')) }}

                                  <a class="btn" href="{{ URL::to('/admin-panel/dashboard') }}">Cancel</a>

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
