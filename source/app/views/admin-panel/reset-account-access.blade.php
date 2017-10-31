<!-- Page title -->
@section('title')
    Reset Account Access
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
                            <div class="muted pull-left">Reset Account Access</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                {{ Form::open(array('url' => '/admin-panel/update-account-access', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                    <div class="control-group
                                    @if($errors->has('email'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('email', 'Email', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::text('email', $user->email, array('class'=>'input-xlarge focused', 'id'=>'email')) }}



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


                                    <div class="form-actions">
                                        {{ Form::hidden('user_id', $user->id) }}
                                        {{ Form::hidden('account_type', $account_type) }}

                                        {{ Form::submit('Reset', array('class'=>'btn btn-danger btn-large'))}}

                                        <a class="btn" href="{{ URL::to('/admin-panel/'.$account_type) }}">Cancel</a>
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
