<?php

class EmployeeEquipmentController extends \BaseController {
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

        $equipments = EmployeeEquipment::ofEmployeeID(Auth::user()->id)->orderBy('id', 'desc')->get();

        $this->layout->content = View::make('employee-panel.equipments.index')
            ->with('equipments', $equipments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make('employee-panel.equipments.create');
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
            'name'       => 'required|min:2|max:50',
            'quantity' => 'required|max:20',
            'reason' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/employee-panel/equipments/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $equipment = new EmployeeEquipment;
            $equipment->name       = Input::get('name');
            $equipment->reason       = Input::get('reason');
            $equipment->quantity       = Input::get('quantity');
            $equipment->employee_id       = Input::get('employee_id');
            $equipment->status       = '3';
            $equipment->save();


            //flash message
            $name = Input::get('name');
            Session::flash('success_message', "<b>$name</b> equipment request has been created");
            // redirect
            return Redirect::to('/employee-panel/equipments');
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
        $equipment = EmployeeEquipment::ofEmployeeID(Auth::user()->id)->find($id);


        $this->layout->content = View::make('employee-panel.equipments.show')
            ->with('equipment', $equipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $equipment = EmployeeEquipment::ofEmployeeID(Auth::user()->id)->find($id);

        $this->layout->content = View::make('employee-panel.equipments.edit')
        ->with('equipment', $equipment);

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
            'name'       => 'required|min:2|max:50',
            'quantity' => 'required|max:20',
            'reason' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/employee-panel/equipments/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $equipment = EmployeeEquipment::find($id);
            $equipment->name       = Input::get('name');
            $equipment->reason       = Input::get('reason');
            $equipment->quantity       = Input::get('quantity');
            $equipment->save();


            //flash message
            $name = Input::get('name');
            Session::flash('success_message', "<b>$name</b> equipment request has been updated");
            // redirect
            return Redirect::to('/employee-panel/equipments');
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
        $equipment = EmployeeEquipment::find($id);
        $equipment->delete();

        // redirect
        Session::flash('success_message', "Successfully deleted");
        return Redirect::to('/employee-panel/equipments');
    }

}
