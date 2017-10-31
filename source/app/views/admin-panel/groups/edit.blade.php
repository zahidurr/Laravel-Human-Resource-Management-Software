<!-- Page title -->
@section('title')
    Edit Group
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
                            <div class="muted pull-left">Edit Group</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view -->
                                {{ Form::model($group, array('route' => array('admin-panel.groups.update', $group->id), 'method' => 'PUT', 'class'=>'form-horizontal', 'id'=>'group-form')) }}
                                <fieldset>
                                <legend>Group Details</legend>
                                <div class="control-group
                                @if($errors->has('name'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('name', 'Name', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('name', Input::old('name'), array('class'=>'input-xlarge focused', 'id'=>'name')) }}

                                  <a tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="e.g. Group A, Programmers, Managers Group"><i class="fa fa-question-circle"></i></a>

                                    <span class="help-block">
                                        @if($errors->has('name'))
                                            {{ $errors->first('name') }}
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
                                  {{ Form::textarea('description', Input::old('description'), array('class'=>'input-xlarge focused', 'id'=>'description')) }}


                                    <span class="help-block">
                                        @if($errors->has('description'))
                                            {{ $errors->first('description') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('members'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('members', 'Members', array('class' => 'control-label')) }}
                                  <div class="controls">

                                  {{ Form::select('members', $members, $group_members, array( 'multiple' => 'multiple', 'id' => 'members', 'name' => 'members[]', 'class' => 'chzn-select')) }}


                                    <span class="help-block">
                                        @if($errors->has('members'))
                                            {{ $errors->first('members') }}
                                        @endif
                                    </span>
                                  </div>
                                </div>
                                <div class="form-actions">
                                    {{ Form::hidden('created_by', Auth::user()->id) }}

                                  {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large'))}}

                                  <a class="btn" href="{{ URL::to('/admin-panel/groups') }}">Cancel</a>

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
