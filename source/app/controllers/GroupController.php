<?php

class GroupController extends \BaseController {
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

        $groups = Group::all();

        $this->layout->content = View::make('admin-panel.groups.index')
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $members = Employee::lists('first_name', 'user_id');

        $this->layout->content = View::make('admin-panel.groups.create')->with('members', $members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name'       => 'required|min:2|max:50|unique:groups,name',
            'description' => 'required|max:300',
            'members' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/groups/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $group = new Group;
            $group->name       = Input::get('name');
            $group->description       = Input::get('description');
            $group->created_by       = Input::get('created_by');
            $group->save();

            $last_group_id = $group->id;

            //Get assigned user list
            $assigned_users = Input::get('members');

            //make insertion array
            $insert_data = array();
            foreach ($assigned_users as $key => $value)
            {
                $insert_data[] = array (
                    'group_id' => $last_group_id,
                    'user_id' => $value,
                );
            }

            //Insert data into Group_members table
            GroupMember::insert(
                $insert_data
            );

            //flash message
            $name = Input::get('name');
            Session::flash('success_message', "<b>$name</b> has been created");
            // redirect
            return Redirect::to('/admin-panel/groups');
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

        $group = Group::find($id);

        $members = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->leftJoin('group_members', 'users.id', '=', 'group_members.user_id')
        ->select('users.id', 'users.email', 'employees.first_name', 'employees.last_name', 'employees.phone', 'employees.profile_image')
        ->where('group_members.group_id', $id)
        ->get();

        $this->layout->content = View::make('admin-panel.groups.show')
            ->with('group', $group)
            ->with('members', $members);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $group = Group::find($id);

        $members = Employee::lists('first_name', 'user_id');

        $group_members = GroupMember::where('group_id', '=', $id)->lists('user_id', 'user_id');

        $this->layout->content = View::make('admin-panel.groups.edit')
        ->with('group', $group)
        ->with('members', $members)
        ->with('group_members', $group_members);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'name'       => 'required|min:2|max:50|unique:groups,name,'.$id,
            'description' => 'required|max:300',
            'members' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/groups/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $group = Group::find($id);
            $group->name       = Input::get('name');
            $group->description       = Input::get('description');
            $group->save();

            //delete old records
            GroupMember::where('group_id', '=', $id)->delete();

            //Get assigned user list
            $assigned_users = Input::get('members');

            //make insertion array
            $insert_data = array();
            foreach ($assigned_users as $key => $value)
            {
                $insert_data[] = array (
                    'group_id' => $id,
                    'user_id' => $value,
                );
            }

            //Insert data into Group_members table
            GroupMember::insert(
                $insert_data
            );

            //flash message
            $name = Input::get('name');
            Session::flash('success_message', "<b>$name</b> has been updated");
            // redirect
            return Redirect::to('/admin-panel/groups');
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
        $group = Group::find($id);
        $group->delete();

        //delete old records
        GroupMember::where('group_id', '=', $id)->delete();

        // redirect
        Session::flash('success_message', "Successfully deleted");
        return Redirect::to('/admin-panel/groups');
    }

}
