<?php
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//seeds sample data
		$this->call('AdminTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('EmployeeTableSeeder');
		$this->call('ApplicantTableSeeder');
		$this->call('AcademicQualificationTableSeeder');
		$this->call('TrainingSummaryTableSeeder');
		$this->call('ProfessionalSummaryTableSeeder');
		$this->call('EmploymentSummaryTableSeeder');
		$this->call('OtherProfileSummaryTableSeeder');
		$this->call('DepartmentTableSeeder');
		$this->call('MaritalStatusTableSeeder');
		$this->call('GenderTableSeeder');
		$this->call('CompanyInfoTableSeeder');
		$this->call('GroupsTableSeeder');
		$this->call('GroupMembersTableSeeder');
		$this->call('SettingsTableSeeder');

		//Confirmation message
		$this->command->info('All tables seeded!');
	}

}

/**
*
* Sample data for Admin table
*
*/
class AdminTableSeeder extends Seeder {

	public function run()
	{
		DB::table('admins')->truncate();

		Admin::insert(
			array(
				array(
					'user_id' => '1',
					'first_name' => 'Oscar',
					'last_name' => 'Cantu',
					'phone' => '15645707281',
					'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png'
				),
				array(
					'user_id' => '2',
					'first_name' => 'Alvin',
					'last_name' => 'Sweeney',
					'phone' => '15645707282',
					'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png'
				)
			)
		);
	}

}

/**
*
* Sample data for Users table
*
*/
class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();

		$date_time = new DateTime();
		User::insert(

			array(
				array(
					'email' => 'admin@example.com',
					'password' => Hash::make('123456'),
					'role' => '1',
					'created_at' => $date_time,
					'updated_at' => $date_time
				),
				array(
					'email' => 'admin2@example.com',
					'password' => Hash::make('123456'),
					'role' => '1',
					'created_at' => $date_time,
					'updated_at' => $date_time
				),
				array(
					'email' => 'employee@example.com',
					'password' => Hash::make('123456'),
					'role' => '2',
					'created_at' => $date_time,
					'updated_at' => $date_time
				),
				array(
					'email' => 'employee2@example.com',
					'password' => Hash::make('123456'),
					'role' => '2',
					'created_at' => $date_time,
					'updated_at' => $date_time
				),
				array(
					'email' => 'employee3@example.com',
					'password' => Hash::make('123456'),
					'role' => '2',
					'created_at' => $date_time,
					'updated_at' => $date_time
				),
				array(
					'email' => 'employee4@example.com',
					'password' => Hash::make('123456'),
					'role' => '2',
					'created_at' => $date_time,
					'updated_at' => $date_time
				),
				array(
					'email' => 'employee5@example.com',
					'password' => Hash::make('123456'),
					'role' => '2',
					'created_at' => $date_time,
					'updated_at' => $date_time
				)

			));
	}

}

/**
*
* Sample data for Employees table
*
*/
class EmployeeTableSeeder extends Seeder {

	public function run()
	{
		DB::table('employees')->truncate();

		$date_time = new DateTime();
		Employee::insert(

			array(
				array(
			        'user_id' => '3',
			        'first_name' => 'Nathaniel',
			        'last_name' => 'Farmer',
			        'main_email' => 'employee@example.com',
			        'alternative_email' => 'employee_ae1@example.com',
			        'phone' => '15645707281',
			        'alternative_phone' => '156457072811',
			        'ssn' => '112233',
			        'department_id' => '1',
			        'employee_id' => '12345',
			        'designation' => 'CEO',
			        'joining_date' => '2009-01-24',
			        'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),
				array(
					'user_id' => '4',
					'first_name' => 'Oscar',
					'last_name' => 'Cantu',
					'main_email' => 'employee2@example.com',
					'alternative_email' => 'employee_ae2@example.com',
					'phone' => '15645707276',
					'alternative_phone' => '156457072762',
					'ssn' => '112244',
					'department_id' => '2',
					'employee_id' => '12345',
			        'designation' => 'Software Engineer',
			        'joining_date' => '2009-01-24',
					'dob' => '1980-01-24',
					'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
					'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
				),array(
			        'user_id' => '5',
			        'first_name' => 'Alvin',
			        'last_name' => 'Sweeney',
					'main_email' => 'employee3@example.com',
			        'alternative_email' => 'employee_ae3@example.com',
			        'phone' => '15645707277',
			        'alternative_phone' => '156457072773',
			        'ssn' => '112233',
					'department_id' => '3',
					'employee_id' => '12345',
			        'designation' => 'Software Engineer',
			        'joining_date' => '2009-01-24',
					'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),array(
			        'user_id' => '6',
			        'first_name' => 'Ferris',
			        'last_name' => 'Nieves',
					'main_email' => 'employee4@example.com',
			        'alternative_email' => 'employee_ae4@example.com',
			        'phone' => '15645707278',
			        'alternative_phone' => '156457072784',
			        'ssn' => '112233',
					'department_id' => '4',
					'employee_id' => '12345',
			        'designation' => 'Software Engineer',
			        'joining_date' => '2009-01-24',
					'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),array(
			        'user_id' => '7',
			        'first_name' => 'Nasim',
			        'last_name' => 'Arber',
					'main_email' => 'employee5@example.com',
			        'alternative_email' => 'employee_ae5@example.com',
			        'phone' => '15645707279',
			        'alternative_phone' => '156457072797',
			        'ssn' => '112233',
					'department_id' => '5',
					'employee_id' => '12345',
			        'designation' => 'Software Engineer',
			        'joining_date' => '2009-01-24',
					'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),
			));
	}

}


/**
*
* Sample data for Applicants table
*
*/
class ApplicantTableSeeder extends Seeder {

	public function run()
	{
		DB::table('applicants')->truncate();

		$date_time = new DateTime();
		Applicant::insert(

			array(
				array(
			        'first_name' => 'Price',
			        'last_name' => 'Bender',
					'email' => 'applicant1@example.com',
			        'alternative_email' => 'applicant_ae1@example.com',
			        'phone' => '15645707295',
			        'alternative_phone' => '156457072953',
			        'ssn' => '112233',
					'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),
				array(
					'first_name' => 'Oscar',
					'last_name' => 'Cantu',
					'email' => 'applicant2@example.com',
					'alternative_email' => 'applicant_ae2@example.com',
					'phone' => '15645707294',
					'alternative_phone' => '156457072944',
					'ssn' => '112244',
					'dob' => '1980-01-24',
					'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
					'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
				),array(
			        'first_name' => 'Alvin',
			        'last_name' => 'Sweeney',
					'email' => 'applicant3@example.com',
			        'alternative_email' => 'applicant_ae3@example.com',
			        'phone' => '15645707274',
			        'alternative_phone' => '1564570727410',
			        'ssn' => '112233',
					'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),array(
			        'first_name' => 'Ferris',
			        'last_name' => 'Nieves',
					'email' => 'applicant4@example.com',
			        'alternative_email' => 'applicant_ae4@example.com',
			        'phone' => '15645707291',
			        'alternative_phone' => '156457072914',
			        'ssn' => '112233',
					'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),array(
			        'first_name' => 'Nasim',
			        'last_name' => 'Arber',
					'email' => 'applicant5@example.com',
			        'alternative_email' => 'applicant_ae5@example.com',
			        'phone' => '15645707285',
			        'alternative_phone' => '156457072855',
			        'ssn' => '112233',
					'dob' => '1980-01-24',
			        'nationality' => 'Canadian',
					'father_name' => 'Darius Bailey',
					'mother_name' => 'Neville Shelton',
			        'address' => '662-1696 Gravida. Av.',
					'profile_image' => 'preview.png',
			    ),
			));
	}

}

/**
*
* Sample data for AcademicQualification table
*
*/
class AcademicQualificationTableSeeder extends Seeder {

	public function run()
	{
		DB::table('academic_qualifications')->truncate();

		AcademicQualification::insert(

			array(
				array('user_id' => '3'),
				array('user_id' => '4'),
				array('user_id' => '5'),
				array('user_id' => '6'),
				array('user_id' => '7')
			)
		);

		AcademicQualification::insert(

			array(
				array('applicant_id' => '1'),
				array('applicant_id' => '2'),
				array('applicant_id' => '3'),
				array('applicant_id' => '4'),
				array('applicant_id' => '5')
			)
		);
	}

}

/**
*
* Sample data for TrainingSummary table
*
*/
class TrainingSummaryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('training_summaries')->truncate();

		TrainingSummary::insert(
			array(
				array('user_id' => '3'),
				array('user_id' => '4'),
				array('user_id' => '5'),
				array('user_id' => '6'),
				array('user_id' => '7')
			)
		);

		TrainingSummary::insert(
			array(
				array('applicant_id' => '1'),
				array('applicant_id' => '2'),
				array('applicant_id' => '3'),
				array('applicant_id' => '4'),
				array('applicant_id' => '5')
			)
		);
	}

}

/**
*
* Sample data for ProfessionalSummary table
*
*/
class ProfessionalSummaryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('professional_summaries')->truncate();

		ProfessionalSummary::insert(
			array(
				array('user_id' => '3'),
				array('user_id' => '4'),
				array('user_id' => '5'),
				array('user_id' => '6'),
				array('user_id' => '7')
			)
		);

		ProfessionalSummary::insert(
			array(
				array('applicant_id' => '1'),
				array('applicant_id' => '2'),
				array('applicant_id' => '3'),
				array('applicant_id' => '4'),
				array('applicant_id' => '5')
			)
		);
	}
}

/**
*
* Sample data for EmploymentSummary table
*
*/
class EmploymentSummaryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('employment_summaries')->truncate();

		EmploymentSummary::insert(
			array(
				array('user_id' => '3'),
				array('user_id' => '4'),
				array('user_id' => '5'),
				array('user_id' => '6'),
				array('user_id' => '7')
			)
		);

		EmploymentSummary::insert(
			array(
				array('applicant_id' => '1'),
				array('applicant_id' => '2'),
				array('applicant_id' => '3'),
				array('applicant_id' => '4'),
				array('applicant_id' => '5')
			)
		);
	}
}


/**
*
* Sample data for OtherProfileSummary table
*
*/
class OtherProfileSummaryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('other_profile_summaries')->truncate();

		OtherProfileSummary::insert(
			array(
				array('user_id' => '3'),
				array('user_id' => '4'),
				array('user_id' => '5'),
				array('user_id' => '6'),
				array('user_id' => '7')
			)
		);

		OtherProfileSummary::insert(
			array(
				array('applicant_id' => '1'),
				array('applicant_id' => '2'),
				array('applicant_id' => '3'),
				array('applicant_id' => '4'),
				array('applicant_id' => '5')
			)
		);
	}
}

/**
*
* Sample data for Department table
*
*/
class DepartmentTableSeeder extends Seeder {

	public function run()
	{
		DB::table('departments')->truncate();

		$date_time = new DateTime();
		Department::insert(
			array(
				array('name' => 'Accounting', 'head' => '3', 'created_at' => $date_time, 'updated_at' => $date_time ),
				array('name' => 'Human Resource', 'head' => '4', 'created_at' => $date_time, 'updated_at' => $date_time ),
				array('name' => 'IT', 'head' => '5', 'created_at' => $date_time, 'updated_at' => $date_time ),
				array('name' => 'Marketing', 'head' => '6', 'created_at' => $date_time, 'updated_at' => $date_time ),
				array('name' => 'Finance', 'head' => '7', 'created_at' => $date_time, 'updated_at' => $date_time )
			)
		);
	}

}

/**
*
* Sample data for MaritalStatus table
*
*/
class MaritalStatusTableSeeder extends Seeder {

	public function run()
	{
		DB::table('marital_statuses')->truncate();

		MaritalStatus::insert(
			array(
				array('name' => 'Single'),
				array('name' => 'Married'),
				array('name' => 'Divorced'),
				array('name' => 'Widowed')
			)
		);
	}

}

/**
*
* Sample data for Gender table
*
*/
class GenderTableSeeder extends Seeder {

	public function run()
	{
		DB::table('genders')->truncate();

		Gender::insert(
			array(
				array('name' => 'Male'),
				array('name' => 'Female'),
				array('name' => 'Other')
			)
		);
	}

}

/**
*
* Sample data for CompanyInfo table
*
*/
class CompanyInfoTableSeeder extends Seeder {

	public function run()
	{
		DB::table('company_infos')->truncate();

		CompanyInfo::insert(
			array(
				array(
					'name' => 'HRMS Software',
					'phone' => '444-555-666',
					'email' => 'support@example.com',
					'website' => 'www.example.com',
					'address' => 'P.O. Box 140, 8866 Rutrum Avenue',
					'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget erat magna. Pellentesque justo ante, sollicitudin eget, interdum id nibh.',
					'latitude' => '57.7973433',
					'longitude' => '12.0502107'
				)
			)
		);
	}

}

/**
*
* Sample data for Groups table
*
*/
class GroupsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('groups')->truncate();

		$date_time = new DateTime();

		Group::insert(
			array(
				array('name' => 'Group A', 'description' => 'This is for Group A', 'created_by' => '1', 'created_at' => $date_time, 'updated_at' => $date_time),
				array('name' => 'Group B', 'description' => 'This is for Group B', 'created_by' => '1', 'created_at' => $date_time, 'updated_at' => $date_time),
				array('name' => 'Group C', 'description' => 'This is for Group C', 'created_by' => '1', 'created_at' => $date_time, 'updated_at' => $date_time),
				array('name' => 'Group D', 'description' => 'This is for Group D', 'created_by' => '1', 'created_at' => $date_time, 'updated_at' => $date_time),
				array('name' => 'Group E', 'description' => 'This is for Group E', 'created_by' => '1', 'created_at' => $date_time, 'updated_at' => $date_time)
			)
		);
	}

}

/**
*
* Sample data for GroupMembers table
*
*/
class GroupMembersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('group_members')->truncate();

		GroupMember::insert(
			array(
				array('group_id' => '1', 'user_id' => '3'),
				array('group_id' => '1', 'user_id' => '6'),
				array('group_id' => '1', 'user_id' => '7'),
				array('group_id' => '2', 'user_id' => '4'),
				array('group_id' => '2', 'user_id' => '5'),
				array('group_id' => '2', 'user_id' => '6'),
				array('group_id' => '3', 'user_id' => '3'),
				array('group_id' => '3', 'user_id' => '3'),
				array('group_id' => '3', 'user_id' => '4'),
				array('group_id' => '4', 'user_id' => '4'),
				array('group_id' => '4', 'user_id' => '5'),
				array('group_id' => '4', 'user_id' => '6'),
				array('group_id' => '5', 'user_id' => '5'),
				array('group_id' => '5', 'user_id' => '7'),
				array('group_id' => '5', 'user_id' => '4')
			)
		);
	}

}

/**
*
* Sample data for Settings table
*
*/
class SettingsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('settings')->truncate();

		Setting::insert(
			array(
				array('id' => '1', 'office_hour_start' => '09', 'office_hour_end' => '17', 'temperature_units' => 'F', 'ip_range' => 'localhost', 'weather_zip' => '94089', 'office_weekday_start' => '1', 'office_weekday_end' => '5')
			)
		);
	}

}
