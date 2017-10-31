<!-- Page title -->
@section('title')
    Create New Department
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
                            <div class="muted pull-left">Create New Department</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view  -->
                                {{ Form::open(array('url' => '/admin-panel/departments', 'class'=>'form-horizontal', 'id'=>'department-form')) }}

                                <fieldset>
                                <legend>Department Details</legend>
                                <div class="control-group
                                @if($errors->has('name'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('name', 'Name', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('name', '', array('class'=>'input-xlarge focused', 'id'=>'name')) }}


                                  <a tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="e.g. Marketing, Accounting, IT, HR"><i class="fa fa-question-circle"></i></a>

                                    <span class="help-block">
                                        @if($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('head'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('head', 'Head', array('class' => 'control-label')) }}
                                  <div class="controls">

                                  {{ Form::select('head', $users, Input::old('head'), array('id' => 'head', 'class' => 'chzn-select')) }}


                                    <span class="help-block">
                                        @if($errors->has('head'))
                                            {{ $errors->first('head') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>
                                <div class="form-actions">

                                  {{ Form::submit('Create', array('class'=>'btn btn-danger btn-large'))}}

                                  <a class="btn" href="{{ URL::to('/admin-panel/departments') }}">Cancel</a>

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
