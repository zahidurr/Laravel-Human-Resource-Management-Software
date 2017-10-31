<?php

class UtilController extends \BaseController {
    /**
	 * Master layouts (HTML & CSS files) and design for all pages.
	 *
     * @var string
	 */
    protected $layout = "layouts.master";

    /**
     * 'auth' filter checks for user's login authentication
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function __construct() {
      $this->beforeFilter('auth');
    }

    /**
     * Get board Members Name from a listing of the resource.
     *
     * @return string
     */
    public function boardMembersName($id)
    {

        $board_members_name = DB::table('interview_boards')
        ->join('admins', 'interview_boards.interview_by', '=', 'admins.user_id')
        ->where('interview_boards.interview_schedule_id', '=', $id)
        ->select('admins.first_name', 'admins.last_name')
        ->get();

        $output = array();
        foreach($board_members_name as $value)
        {
            $output[] = $value->first_name . ' ' . $value->last_name;
        }

        return implode(',<br>', $output);
    }


    /**
     * Get department name from a listing of the resource.
     *
     * @return string
     */
    public function departmentName($id)
    {

        $department = Department::find($id);

        $output = '';
        if($department)
            $output = $department->name;

        return $output;
    }

    /**
     * Get user full  name from a listing of the resource.
     *
     * @return string
     */
    public function userFullName($id, $model='Admin')
    {

        $data = $model::where('user_id', '=', $id)->first();

        $full_name = '';
        if($data)
            $full_name = $data->first_name . ' ' . $data->last_name;

        return $full_name;
    }

    /**
     * Get user profile image name from a listing of the resource.
     *
     * @return string
     */
    public function userProfileImageName($id, $model='Admin')
    {

        $data = $model::where('user_id', '=', $id)->first();

        $name = 'preview.png';
        if($data)
            $name = $data->profile_image;

        return $name;
    }

    /**
     * Get total department members from a listing of the resource.
     *
     * @return int
     */
    public function totalDepartmentMembers($id)
    {
        $data = Employee::where('department_id', '=', $id);
        $total_members = $data->count();

        return $total_members;
    }

    /**
     * Get total group members from a listing of the resource.
     *
     * @return int
     */
    public function totalGroupMembers($id)
    {
        $data = GroupMember::where('group_id', '=', $id);
        $total_members = $data->count();

        return $total_members;
    }

    /**
     * Get gender name from a listing of the resource.
     *
     * @return string
     */
    public function genderName($id)
    {
        $gender = Gender::find($id);

        $output = '';
        if($gender)
            $output = $gender->name;

        return $output;
    }

    /**
     * Get marital status name from a listing of the resource.
     *
     * @return string
     */
    public function maritalStatusName($id)
    {
        $marital_status = MaritalStatus::find($id);

        $output = '';
        if($marital_status)
            $output = $marital_status->name;

        return $output;
    }

    /**
     * Get company name from a listing of the resource.
     *
     * @return string
     */
    public function companyName()
    {
        $company_info = CompanyInfo::orderby('id', 'desc')->first();

        $output = '';
        if($company_info)
            $output = $company_info->name;

        return $output;
    }

    /**
     * Verify today is holiday
     *
     * @return bool
     */
    public function isTodayHoliday()
    {

        $settings = Setting::find(1);

        $output = true;

        $date_no = date('N');
        if($settings->office_weekday_start <= $date_no && $settings->office_weekday_end >= $date_no)
            $output = false;

        return $output;
    }

    /**
     * Get weather details from yahoo apis
     *
     * @return string
     */
    public function showWeather ()
    {
        //query zip and units
        $settings = Setting::find(1);
        $zipcode = $settings->weather_zip;
        $units = $settings->temperature_units;

    	//yahoo api call
    	$result = file_get_contents('http://weather.yahooapis.com/forecastrss?p=' . $zipcode . '&u='.$units.'&d=3');
    	$xml = simplexml_load_string($result);

    	 //get data
    	$xml->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
    	$location = $xml->channel->xpath('yweather:location');

        $output = "<small>".date('F j, Y')."</small><br><b>".date('l')."</b><br>";

    	if(!empty($location)) {
    		foreach($xml->channel->item as $item)
    		{
    			$current = $item->xpath('yweather:condition');
    			$forecast = $item->xpath('yweather:forecast');
    			$current = $current[0];

    			//formate data

    			$output .= "
    			<img src=\"http://l.yimg.com/a/i/us/we/52/{$current['code']}.gif\" style=\"vertical-align: middle;\" alt=\"img\" />&nbsp;
    			{$current['text']},
    			<span style=\"font-size:30px; font-weight:bold;\">{$current['temp']}&deg;$units</span>
    			<br>
                <i class=\"fa fa-map-marker\"></i> <b>{$location[0]['city']}, {$location[0]['region']}</b>
                <br>
    			<u>Forecast</u>:<br>
                <span style='font-size:small;'>
    			{$forecast[0]['day']} - {$forecast[0]['text']}. High: {$forecast[0]['high']} Low: {$forecast[0]['low']}
    			<br>
    			{$forecast[1]['day']} - {$forecast[1]['text']}. High: {$forecast[1]['high']} Low: {$forecast[1]['low']}
                <br>
    			{$forecast[2]['day']} - {$forecast[2]['text']}. High: {$forecast[2]['high']} Low: {$forecast[2]['low']}
                </span>
                <br><br>
                <span style='font-size:xx-small; color:gray;'>Source: <a href='https://weather.yahoo.com/' style='color:gray;'>Yahoo Weather</a></span>
                ";
    		}
    	} else {
            $output .= '<br><br>No weather forecast found, please try a different Zip code or Location ID';
        }

    	return $output;
    }
}
