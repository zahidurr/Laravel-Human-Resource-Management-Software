<!DOCTYPE html>
<html>
  <head>
    <title>Sign in | {{ App::make('UtilController')->companyName () }}</title>
    <!-- Bootstrap -->
    {{ HTML::style('/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('/bootstrap/css/bootstrap-responsive.min.css') }}

    {{ HTML::style('/vendors/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('/assets/styles.css') }}

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      {{ HTML::script('//html5shim.googlecode.com/svn/trunk/html5.js') }}
    <![endif]-->

    {{ HTML::script('/vendors/modernizr-2.6.2-respond-1.1.0.min.js') }}
  </head>
  <body id="login">
    <div class="container">

        <div class="form-signin" id="login-form">
          <div class="control-group">
            <div class="controls" style="text-align:center;">
                <img src="{{ asset('/uploads/company_logo.png') }}" alt="Logo" />
                <br><br>
            </div>
          </div>

          <!-- Display error flash message here -->
          @if(Session::has('login_error'))
          <div class="alert alert-error">
              <button class="close" data-dismiss="alert">&times;</button>
              <i class="fa fa-exclamation-circle"></i> {{ Session::get('login_error') }}
          </div>
          @endif

          <!-- Display info flash message here -->
          @if(Session::has('login_info'))
          <div class="alert alert-info">
              <button class="close" data-dismiss="alert">&times;</button>
              <i class="fa fa-info-circle"></i> {{ Session::get('login_info') }}
          </div>
          @endif

          <!-- Login form view -->
          {{ Form::open(array('url' => 'signin')) }}
              <div class="control-group">
                <div class="controls">
                    {{ Form::text('email', '', array('class'=>'input-xlarge focused', 'id'=>'email','placeholder'=>'Email', 'required'=>'required')) }}

                    <span class="help-block"></span>
                </div>
              </div>

              <div class="control-group">
                <div class="controls">
                      {{ Form::password('password', array('class'=>'input-xlarge', 'id'=>'password', 'placeholder'=>' Password', 'required'=>'required')) }}
                      <span class="help-block"></span>

                </div>
              </div>

              <div class="control-group">
                <div class="controls">
                    {{ Form::submit('Sign in', array('class'=>'btn btn-primary')) }}
                </div>
              </div>

                <div class="control-group">

                    <div class="controls">
                        <label class="checkbox">
                            {{ Form::checkbox('remember_me', 'Y', null) }} Keep me signed in
                        </label>
                    </div>
              </div>

              <div class="control-group">

                <div class="controls">
                    <a class="popover-top" tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="To request account access reset, please contact your administrators">Unable to access your account?</a>

              </div>
            </div>

          {{ Form::close() }}

      </div>
    </div>

    <!-- required javascript files -->
    {{ HTML::script('/vendors/jquery-1.9.1.min.js') }}
    {{ HTML::script('/vendors/jquery.validate.min.js') }}
    {{ HTML::script('/vendors/additional-methods.min.js') }}
    {{ HTML::script('/bootstrap/js/bootstrap.min.js') }}

    {{ HTML::script('/vendors/jquery.uniform.min.js') }}
    {{ HTML::script('/vendors/chosen.jquery.min.js') }}
    {{ HTML::script('/vendors/bootstrap-datetimepicker.min.js') }}

    {{ HTML::script('/vendors/wysiwyg/bootstrap-wysihtml5.js') }}
    {{ HTML::script('/vendors/wizard/jquery.bootstrap.wizard.min.js') }}
    {{ HTML::script('/js/form.js'); }}

  </body>
</html>
