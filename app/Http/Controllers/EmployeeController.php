<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Employee;
use App\Models\Institution;

class EmployeeController extends Controller
{
    public static function addEmployee($request,$contact)
    {
    	$employee = new Employee();
    	$employee->keyword = $request->keyword;

    	$contact->employee()->save($employee);

    	return ['success' => true];    
    }

    public static function modifyEmployee($request,$contact)
    {
		$employee = Employee::where('id','=',$request->updates['id'])->first();
        $employee->keyword = $request->updates['keyword'];
        $employee->update();

        if(isset($request->updates['new_institution_name']) && $request->updates['new_institution_name'] != "" && isset($request->updates['new_institution_job_title']) && $request->updates['new_institution_job_title'] != ""){

        	$start_date_month = $request->updates['new_institution_start_date']['month'];
        	$start_date_year = $request->updates['new_institution_start_date']['year'];
        	$start_date_day = $request->updates['new_institution_start_date']['day'];
			$start_date = date("Y-m-d", mktime(0, 0, 0, $start_date_month, $start_date_day, $start_date_year));

        	$end_date_month = $request->updates['new_institution_end_date']['month'];
        	$end_date_year = $request->updates['new_institution_end_date']['year'];
        	$end_date_day = $request->updates['new_institution_end_date']['day'];
			$end_date = date("Y-m-d", mktime(0, 0, 0, $end_date_month, $end_date_day, $end_date_year));	

			$institution = new Institution();
			$institution->name = $request->updates['new_institution_name'];
			$institution->job_title = $request->updates['new_institution_job_title'];
			$institution->job_description = $request->updates['new_institution_job_description'];
			$institution->from = $start_date;
			$institution->until = $end_date;

			$employee->institution()->save($institution);
        }

        return ['success' => true]; 
    }

    public static function modifyInstitution($request,$contact)
    {
    	$institution = Institution::where('id','=',$request->updates['id'])->first();

    	$start_date_month = $request->updates['institution_start_date']['month'];
    	$start_date_year = $request->updates['institution_start_date']['year'];
    	$start_date_day = $request->updates['institution_start_date']['day'];
		$start_date = date("Y-m-d", mktime(0, 0, 0, $start_date_month, $start_date_day, $start_date_year));

    	$end_date_month = $request->updates['institution_end_date']['month'];
    	$end_date_year = $request->updates['institution_end_date']['year'];
    	$end_date_day = $request->updates['institution_end_date']['day'];
		$end_date = date("Y-m-d", mktime(0, 0, 0, $end_date_month, $end_date_day, $end_date_year));	

		$institution->name = $request->updates['institution_name'];
		$institution->job_title = $request->updates['institution_job_title'];
		$institution->job_description = $request->updates['institution_job_description'];
		$institution->from = $start_date;
		$institution->until = $end_date; 
		$institution->update();

		return ['success' => true];

    }

    public static function deleteInstitution($request,$contact)
    {
    	$institution = Institution::where('id','=',$request->institution_id)->first();
    	$institution->delete();

		return ['success' => true];  
    }

    public static function deleteEmployee($request,$contact)
    {
		$employee = Employee::where('id','=',$request->employee_id)->first();

        if(isset($employee->institution)){
            foreach ($employee->institution as $institution){
                $institution->delete();
            }                
        }

        $employee->delete();

    	return ['success' => true];		    	
    }
}
