<?php

class EmployeeLeaveController extends \BaseController {
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
     * 'employee' filter checks for user is employee or not
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth');
        $this->beforeFilter('employee');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $leaves = EmployeeLeave::ofEmployeeID(Auth::user()->id)->orderBy('id', 'desc')->get();

        $this->layout->content = View::make('employee-panel.leave.index')
            ->with('leaves', $leaves);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make('employee-panel.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $date_now = date('Y-m-d', strtotime('-1 days'));
        $rules = array(
            'type'       => 'required|min:2|max:50',
            'from_date' => 'required|date|date_format:"Y-m-d"|after:'.$date_now,
            'to_date' => 'required|date|date_format:"Y-m-d"|after:from_date',
            'reason' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/employee-panel/leave/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $leave = new EmployeeLeave;
            $leave->type       = Input::get('type');
            $leave->reason       = Input::get('reason');
            $leave->from_date       = Input::get('from_date');
            $leave->to_date       = Input::get('to_date');
            $leave->employee_id       = Input::get('employee_id');
            $leave->status       = '3';
            $leave->save();


            //flash message
            $type = Input::get('type');
            Session::flash('success_message', "<b>$type</b> leave request has been created");
            // redirect
            return Redirect::to('/employee-panel/leave');
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
        $leave = EmployeeLeave::ofEmployeeID(Auth::user()->id)->find($id);


        $this->layout->content = View::make('employee-panel.leave.show')
            ->with('leave', $leave);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $leave = EmployeeLeave::ofEmployeeID(Auth::user()->id)->find($id);

        $this->layout->content = View::make('employee-panel.leave.edit')
        ->with('leave', $leave);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $date_now = date('Y-m-d', strtotime('-1 days'));

        $rules = array(
            'type'       => 'required|min:2|max:50',
            'from_date' => 'required|date|date_format:"Y-m-d"|after:'.$date_now,
            'to_date' => 'required|date|date_format:"Y-m-d"|after:from_date',
            'reason' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/employee-panel/leave/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $leave = EmployeeLeave::find($id);
            $leave->type       = Input::get('type');
            $leave->reason       = Input::get('reason');
            $leave->from_date       = Input::get('from_date');
            $leave->to_date       = Input::get('to_date');
            $leave->save();


            //flash message
            $type = Input::get('type');
            Session::flash('success_message', "<b>$type</b> leave request has been updated");
            // redirect
            return Redirect::to('/employee-panel/leave');
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
        $leave = EmployeeLeave::find($id);
        $leave->delete();

        // redirect
        Session::flash('success_message', "Successfully deleted");
        return Redirect::to('/employee-panel/leave');
    }

}
