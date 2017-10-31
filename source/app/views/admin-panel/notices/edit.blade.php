<!-- Page title -->
@section('title')
    Edit Notice
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
                            <div class="muted pull-left">Edit Notice</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view -->
                                {{ Form::model($notice, array('route' => array('admin-panel.notices.update', $notice->id), 'method' => 'PUT', 'class'=>'form-horizontal', 'id'=>'notice-form')) }}
                                <fieldset>

                                <legend>Notice Details</legend>
                                <div class="control-group
                                @if($errors->has('title'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('title', 'Title', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('title',  Input::old('title'), array('class'=>'input-xlarge focused', 'id'=>'title', 'placeholder'=>'Board Meeting')) }}

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
                                @if($errors->has('viewers'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('viewers', 'Viewer Group', array('class' => 'control-label')) }}
                                  <div class="controls">

                                  {{ Form::select('viewers', $viewers, $notice_viewers, array( 'multiple' => 'multiple', 'id' => 'viewers', 'name' => 'viewers[]', 'class' => 'chzn-select')) }}


                                    <span class="help-block">
                                        @if($errors->has('viewers'))
                                            {{ $errors->first('viewers') }}
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
                                      {{ Form::textarea('description', Input::old('description'), array('class'=>'input-xlarge textarea', 'id'=>'description', 'style'=>'width: 75%', 'placeholder'=>"<b>Agenda</b><ul><li>Calling of roll</li><li>Reports</li><li>Reading and approval</li><li>New business</li></ul>")) }}


                                    <span class="help-block">
                                        @if($errors->has('description'))
                                            {{ $errors->first('description') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>
                                <div class="form-actions">

                                  {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large'))}}

                                  <a class="btn" href="{{ URL::to('/admin-panel/notices') }}">Cancel</a>

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
