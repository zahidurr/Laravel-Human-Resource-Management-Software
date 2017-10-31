<!-- Page title -->
@section('title')
    Interview Board
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
                            <div class="muted pull-left">Interview Board</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view  -->
                                {{ Form::open(array('url' => '/admin-panel/update-interview-board', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                    <div class="control-group">

                                      <div class="controls">
                                          <label class="checkbox">
                                          {{ Form::checkbox('applicant_selected', '1', $applicant_selected) }} Applicant Selected
                                      </label>
                                      </div>
                                    </div>

                                    <div class="control-group">

                                      <div class="controls">
                                          <label class="checkbox">
                                          {{ Form::checkbox('job_accepted', '1', $job_accepted) }} Qualified for Job
                                      </label>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('marks'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('marks', 'Marks', array('class' => 'control-label')) }}
                                      <div class="controls">
                                      {{ Form::text('marks',  $interview_board->marks, array('class'=>'input-xlarge focused', 'id'=>'marks', 'placeholder'=>'Out of 100')) }}

                                        <span class="help-block">
                                            @if($errors->has('marks'))
                                                {{ $errors->first('marks') }}
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
                                      {{ Form::textarea('comment',  $interview_board->comment, array('class'=>'input-xlarge focused', 'id'=>'comment', 'placeholder'=>'Write here...')) }}

                                        <span class="help-block">
                                            @if($errors->has('comment'))
                                                {{ $errors->first('comment') }}
                                            @endif
                                        </span>

                                      </div>
                                    </div>


                                    <div class="form-actions">
                                        {{ Form::hidden('interview_schedule_id', $interview_board->interview_schedule_id) }}

                                      {{ Form::submit('Done', array('class'=>'btn btn-danger btn-large'))}}

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
