<?php

class AdminManagementController extends \BaseController {

    /**
	 * Master layouts (HTML & CSS files) and design for all pages.
	 *
     * @var string
	 */
    protected $layout = "layouts.master";

    /**
     * 'csrf' filter checks for form token validation
     * ------------------------------------------------------------------------
     * 'auth' filter checks for user's login authentication
     * ------------------------------------------------------------------------
     * 'admin' filter checks for user is admin or not
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function __construct() {
      $this->beforeFilter('csrf', array('on'=>'post'));
      $this->beforeFilter('auth');
      $this->beforeFilter('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //admins
        $admins = DB::table('users')
        ->join('admins', 'users.id', '=', 'admins.user_id')
        ->select('users.id', 'users.email', 'admins.first_name', 'admins.last_name', 'admins.phone', 'admins.profile_image')
        ->get();

        // load the view and pass the users
        $this->layout->content = View::make('admin-panel.admins.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make('admin-panel.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required|min:2',
            'last_name'       => 'required|min:2',
            'email'       => 'required|email|unique:users,email',
            'password'       => 'required|min:6',
            'phone' => 'required|unique:admins,phone',
            'address'       => 'required',
            'image' => 'between:1,999|mimes:jpeg,jpg,png,JPG'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store into users table
            $user = new User;
            $user->email       = Input::get('email');
            $user->password       = Hash::make(Input::get('password'));
            $user->role       = '1';
            $user->save();

            $last_inserted_id = $user->id;

            // store into Admins table
            $data = new Admin;
            $data->user_id       = $last_inserted_id;
            $data->first_name       = Input::get('first_name');
            $data->last_name       = Input::get('last_name');
            $data->phone       = Input::get('phone');
            $data->address       = Input::get('address');

            $filename = 'preview.png';
            //verify and save profile image
            if (Input::hasFile('image'))
        	{
        	    $file = Input::file('image');

                $filename = 'admin'.$last_inserted_id . '.' . $file->getClientOriginalExtension();
        	    $file->move('public/uploads/images', $filename);

                $image = Image::make(sprintf('public/uploads/images/%s', $filename))->resize(200, 200)->save();

                //save to DB

        	}

            $data->profile_image       = $filename;
            $data->save();



            $user_full_name = Input::get('first_name'). ' ' . Input::get('last_name');

            // redirect
            Session::flash('success_message', "<b>$user_full_name</b>'s account has been created");
            return Redirect::to('/admin-panel/admins');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //admins
        $admin = DB::table('users')
        ->join('admins', 'users.id', '=', 'admins.user_id')
        ->where('users.id', '=', $id)
        ->first();

        // show the view and pass the user to it
        $this->layout->content = View::make('admin-panel.admins.show')
            ->with('admin', $admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //admins
        $admin = DB::table('users')
        ->join('admins', 'users.id', '=', 'admins.user_id')
        ->where('users.id', '=', $id)
        ->first();


        $this->layout->content = View::make('admin-panel.admins.edit')
        ->with('admin', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required|min:2',
            'last_name'       => 'required|min:2',
            'phone' => 'required|unique:admins,phone,'.$id.',user_id',
            'address'       => 'required',
            'image' => 'between:1,999|mimes:jpeg,jpg,png'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin-panel/admins/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {

            // store into Admins table
            Admin::where('user_id', $id)->update(
            array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'phone' => Input::get('phone'),
                'address' => Input::get('address')
            ));



            $user_full_name = Input::get('first_name'). ' ' . Input::get('last_name');
            // redirect
            Session::flash('success_message', "<b>$user_full_name</b>'s profile has been updated");
            return Redirect::to('/admin-panel/admins');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Admin::where('user_id', '=', $id)->delete();

        // redirect
        Session::flash('success_message', 'Successfully deleted');
        return Redirect::to('/admin-panel/admins');
    }

}
