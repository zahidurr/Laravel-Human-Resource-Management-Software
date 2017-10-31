<!-- Page title -->
@section('title')
    Review Employee Leave
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
                            <div class="muted pull-left">Review Employee Leave</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view -->
                                {{ Form::open(array('url' => '/admin-panel/update-moderate-employee-leave', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                    <div class="control-group
                                    @if($errors->has('status'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('status', 'Status', array('class' => 'control-label')) }}
                                      <div class="controls">

                                      {{ Form::select('status', array('' => 'Select', '1' => 'Approve', '2' => 'Reject'), $leave->status, array('class' => 'form-control')) }}
                                      <span class="help-block">
                                          @if($errors->has('status'))
                                              {{ $errors->first('status') }}
                                          @endif
                                      </span>

                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('comment'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('comment', 'Comment', array('class' => 'control-label')) }}
                                      <div class="controls">
                                      {{ Form::textarea('comment',  $leave->moderator_comment, array('class'=>'input-xlarge focused', 'id'=>'comment', 'placeholder'=>'Write here...')) }}

                                        <span class="help-block">
                                            @if($errors->has('comment'))
                                                {{ $errors->first('comment') }}
                                            @endif
                                        </span>

                                      </div>
                                    </div>


                                    <div class="form-actions">
                                        {{ Form::hidden('leave_id', $leave->id) }}
                                        {{ Form::hidden('moderated_by', Auth::user()->id) }}

                                      {{ Form::submit('Done', array('class'=>'btn btn-danger btn-large'))}}

                                      <a class="btn" href="{{ URL::to('/admin-panel/employee-leave-list') }}">Cancel</a>

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
