<!-- Page title -->
@section('title')
    New Admin Registration
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
                            <div class="muted pull-left">New Admin Registration</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">
                                <ul class="nav nav-tabs" role="tablist" id="usersTab">
                                   <li role="presentation" class="active"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Personal</a></li>

                                   <li role="presentation"><a href="#photograph" aria-controls="photograph" role="tab" data-toggle="tab">Photograph</a></li>
                               </ul>

                               <!-- Form view  -->
                                {{ Form::open(array('url' => '/admin-panel/admins', 'files' => true, 'class'=>'form-horizontal', 'id'=>'user-form')) }}
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
                                    @if($errors->has('phone'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('phone', "Phone", array('class' => 'control-label required')) }}
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
                                    @if($errors->has('address'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('address', "Address", array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::textarea('address', Input::old('address'), array('class'=>'input-xlarge focused', 'id'=>'address')) }}


                                        <span class="help-block">
                                            @if($errors->has('address'))
                                                {{ $errors->first('address') }}
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
                                    </div>

                                    <!-- photograph tab panel -->
                                    <div role="tabpanel" class="tab-pane fade" id="photograph">
                                        <div class="control-group
                                        @if($errors->has('image'))
                                            error
                                        @endif
                                        ">

                                          <div class="controls">
                                              {{ Form::file('image', array('onchange' => 'previewImage(this);')) }}

                                              <a tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="<i class='fa fa-asterisk'></i> File must be less then 1MB in size<br><i class='fa fa-asterisk'></i> File must be in JPEG(.jpg or .jpeg) or PNG(.png) format"><i class="fa fa-info-circle"></i></a>
                                            <span class="help-block">
                                                @if($errors->has('image'))
                                                    {{ $errors->first('image') }}
                                                @endif
                                            </span>

                                            <br>
                                            <img src="{{ asset('images/preview.png') }}" id="image-preview" />

                                          </div>
                                        </div>
                                    </div>
                                    </div>


                                    <div class="form-actions">
                                        <!-- Form submit button -->
                                      {{ Form::submit('Register', array('class'=>'btn btn-danger btn-large')) }}
                                      <a class="btn" href="{{ URL::to('/admin-panel/admins') }}">Cancel</a>

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
