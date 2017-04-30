<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Donor;
use App\Models\Donation;

class DonnerController extends Controller
{
    public static function addDoner($request,$contact)
    {
    	$donor = new Donor();
    	$donor->legal_form = $request->legal_form;
    	$donor->recurring_donations = $request->recurring_donations == "1" ? 1 : 0;

    	$contact->donor()->save($donor);

    	return ['success' => true];
    }

    public static function modifyDonor($request,$contact)
    {
    	$donor = Donor::where('id','=',$request->updates['donor_id'])->first();
    	$donor->legal_form = $request->updates['legal_form'];
    	$donor->recurring_donations = $request->updates['recurring_donations'] == "1" ? 1 : 0;

    	$donor->save();

    	if(isset($request->updates['new_donation']) && $request->updates['new_donation'] == true){
    		$donation = new Donation();
    		$donation->sum = floatval($request->updates['new_donation_sum']);
    		$donation->reward = $request->updates['new_donation_reward'] == "1" ? 1 : 0;
    		$donation->after_campaign = $request->updates['new_donation_after_campaign'] == "1" ? 1 : 0;
    		$donation->comment = $request->updates['new_donation_comment'];
    		$donor->donation()->save($donation);
    	}

    	return ['success' => true];
    }

    public static function modifyDonation($request,$contact)
    {
    	$donation = Donation::where('id','=',$request->updates['id'])->first();
		$donation->sum = floatval($request->updates['donation_sum']);
		$donation->reward = $request->updates['donation_reward'] == "1" ? 1 : 0;
		$donation->after_campaign = $request->updates['donation_after_campaign'] == "1" ? 1 : 0;
		$donation->comment = $request->updates['donation_comment'];    	
		$donation->save();

		return ['success' => true];
    }

    public static function deleteDonation($request,$contact)
    {
    	$donation = Donation::where('id','=',$request->donation_id)->first();
    	$donation->delete();

		return ['success' => true];
    }    

    public static function deleteDoner($request,$contact)
    {
		$donor = Donor::where('id','=',$request->donor_id)->first();

        if(isset($donor->donation)){
            foreach ($donor->donation as $donation){
                $donation->delete();
            }                
        }

        $donor->delete();

    	return ['success' => true];
    }    
}
