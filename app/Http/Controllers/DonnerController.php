<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Donor;

class DonnerController extends Controller
{
    public static function addDonner($request,$contact)
    {
    	$donor = new Donor();
    	$donor->legal_form = $request->legal_form;
    	$donor->recurring_donations = $request->recurring_donations == "1" ? 1 : 0;

    	$contact->donor()->save($donor);

    	return ['success' => true];
    }
}
