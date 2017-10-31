<?php

class AjaxControllerAdmin extends BaseController {

    /**
     * 'auth' filter checks for user's login authentication
     * ------------------------------------------------------------------------
     * 'admin' filter checks for user is admin or not
     * ------------------------------------------------------------------------
     *
	 * @return void
	 */
    public function __construct() {

      $this->beforeFilter('auth');
      $this->beforeFilter('admin');
    }


    /**
     * Upload and store image on database and display response
     *
     * @return void
     */
    public function postUploadImage() {
        $success = false;
        $message = "<span style='color:red;'>Error occurred<span>";

        $rules = array(
            'image' => 'between:1,999|mimes:jpeg,jpg,png,JPG'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            foreach ($validator->messages()->getMessages() as $field_name => $messages)
            {
                $message = "<span style='color:red;'>$messages[0]<span>"; //show validation error
            }

        } else {
            if (Input::hasFile('image'))
            {
                $file = Input::file('image');
                $user_type = Input::get('user_type');
                $user_id = Input::get('user_id');

                $filename = $user_type. $user_id . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/images', $filename);

                $image = Image::make(sprintf('uploads/images/%s', $filename))->resize(200, 200)->save();

                if($image) {
                    //update admin image
                    if($user_type == 'Applicant') {
                        $user_type::where('id', $user_id)->update(
                        array(
                            'profile_image' => $filename
                        ));
                    } else {
                        $user_type::where('user_id', $user_id)->update(
                        array(
                            'profile_image' => $filename
                        ));
                    }


                    //output
                    $success = true;
                    $message = '<span style="color:green;"><i class="fa fa-check-circle-o"></i> Successfully uploaded<span>';
                }

            }
        }

        $output = array(
        	"success" => $success,
        	"message" => $message
        );

        echo json_encode($output);
    }


    /**
     * Upload and store Company Logo on database and display response
     *
     * @return void
     */
    public function postUploadCompanyLogo() {
        $success = false;
        $message = "<span style='color:red;'>Error occurred<span>";

        $rules = array(
            'image' => 'between:1,999|mimes:png'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            foreach ($validator->messages()->getMessages() as $field_name => $messages)
            {
                $message = "<span style='color:red;'>$messages[0]<span>"; //show validation error
            }

        } else {
            if (Input::hasFile('image'))
            {
                $file = Input::file('image');

                $filename = 'company_logo.png';
                $file->move('uploads', $filename);


                Image::make(sprintf('uploads/%s', $filename))->resize(300, 100)->save();

                //output
                $success = true;
                $message = '<span style="color:green;"><i class="fa fa-check-circle-o"></i> Successfully uploaded<span>';

            }
        }

        $output = array(
        	"success" => $success,
        	"message" => $message
        );

        echo json_encode($output);
    }

    /**
     * display Weather Forecast from UtilController
     *
     * @return void
     */
    public function getWeatherForecast() {
        echo App::make('UtilController')->showWeather();
    }
}
