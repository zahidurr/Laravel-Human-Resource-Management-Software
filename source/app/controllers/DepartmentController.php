<?php

class DepartmentController extends \BaseController {
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
        // get all the departments
        $departments = Department::all();

        // load the view and pass the departments
        $this->layout->content = View::make('admin-panel.departments.index')
            ->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = array('' => 'Select') + Employee::lists('first_name', 'user_id');

        $this->layout->content = View::make('admin-panel.departments.create')->with('users', $users);
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
            'name'       => 'required|min:2|unique:departments,name',
            'head' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/departments/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $department = new Department;
            $department->name       = Input::get('name');
            $department->head       = Input::get('head');
            $department->save();

            $name = Input::get('name');
            // redirect
            Session::flash('success_message', "<b>$name</b> has been created");
            return Redirect::to('/admin-panel/departments');
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

        // get the department
        $department = Department::find($id);

        $employees = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->select('users.id', 'users.email', 'employees.first_name', 'employees.last_name', 'employees.phone', 'employees.profile_image')
        ->where('employees.department_id', '=', $id);

        $employees_list = $employees->get();
        $total_members = $employees->count();

        // show the view and pass the department to it
        $this->layout->content = View::make('admin-panel.departments.show')
            ->with('department', $department)
            ->with('employees', $employees_list)
            ->with('total_members', $total_members);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $users = array('' => 'Select') + Employee::lists('first_name', 'user_id');

        // get the department
        $department = Department::find($id);

        // show the edit form and pass the department
        $this->layout->content =  View::make('admin-panel.departments.edit')
            ->with('department', $department)
            ->with('users', $users);
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
            'name'       => 'required|min:2|unique:departments,name,'.$id,
            'head' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/departments/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $department = Department::find($id);
            $department->name       = Input::get('name');
            $department->head       = Input::get('head');
            $department->save();

            $name = Input::get('name');

            // redirect
            Session::flash('success_message', "<b>$name</b> has been updated");
            return Redirect::to('/admin-panel/departments');
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
        // delete
        $department = Department::find($id);
        $department->delete();

        // redirect
        Session::flash('success_message', "Successfully deleted");
        return Redirect::to('/admin-panel/departments');
    }

}
