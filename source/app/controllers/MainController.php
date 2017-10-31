<?php

class MainController extends BaseController {
    /**
	 * Master layouts (HTML & CSS files) and design for all pages.
	 *
     * @var string
	 */
    protected $layout = "layouts.master";

    /**
     * 'csrf' filter checks for form token validation
     * ------------------------------------------------------------------------
     * 'auth' filter checks for user's login authentication except Dashboard & Logout
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function __construct() {
      $this->beforeFilter('csrf', array('on'=>'post'));
      $this->beforeFilter('auth', array('only'=>array('getDashboard', 'getLogout')));
    }

    /**
     * Display a listing of the resource of Login page.
     *
     * @return Response
     */
    public function getLogin() {
        if (Auth::check()) {
            return Redirect::to('dashboard');

        } else {
            return View::make('login');
        }
    }

    /**
     * Validate user's Signin and redirect to dashboard
     *
     * @return Response
     */
    public function postSignin() {
        $data = Input::all();
        $isRememberMe = (Input::get('remember_me') == 'Y') ? true : false;

          if (Auth::attempt(array('email'=>$data['email'], 'password'=>$data['password']), $isRememberMe)) {
              $date_time = new DateTime();
              //Update users log
              Auth::user()->last_login_agent = $_SERVER["HTTP_USER_AGENT"];
              Auth::user()->last_login_at = $date_time;
              Auth::user()->save();

              return Redirect::intended('dashboard');
          } else {
            return Redirect::to('login')
            ->with('login_error', 'Please check your credentials!')
            ->withInput();
          }
    }

    /**
     * Show specefic dashboard based on user type
     *
     * @return Response
     */
    public function getDashboard() {
        if (Auth::check()) {
	        if(Auth::user()->role == 1)
	        	return Redirect::to('admin-panel/dashboard');
	        elseif(Auth::user()->role == 2)
	        	return Redirect::to('employee-panel/dashboard');
            else
    	        return Redirect::to('logout');
	    } else {
	        return Redirect::to('logout');
	    }
    }

    /**
     * Display a listing of the resource of Company Info page
     *
     * @return Response
     */
    public function getCompanyInfo() {
        $company_info = CompanyInfo::orderby('id', 'desc')->first();

        $this->layout->content = View::make('admin-panel.company-info.index')
            ->with('company_info', $company_info);
    }

    /**
     * logout from the account
     *
     * @return Response
     */
    public function getLogout() {
      Auth::logout();
      return Redirect::to('login')->with('login_info', 'Your are signed out!');
    }

}
