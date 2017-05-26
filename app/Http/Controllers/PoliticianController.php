<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Politician;
use App\Models\Partie;
use App\Models\Domain;
use App\Models\Link;

class PoliticianController extends Controller
{
    public static function addPolitician($request,$contact)
    {
    	$politician = new Politician();
    	$politician->position = $request->updates['position'];
    	$politician->intersections_at_events = $request->updates['intersections_at_events'];
    	$politician->known_for = $request->updates['known_for'];
    	$politician->reasonability_rating = $request->updates['reasonability_rating'];
    	$politician->openness_rating = $request->updates['openness_rating'];
    	$politician->liason = $request->updates['liason'];

    	$contact->politician()->save($politician);

        if(isset($request->updates['domains_of_interest']) && $request->updates['domains_of_interest'] != ""){
            foreach ($request->updates['domains_of_interest'] as $new_domain) {
                $domain = new Domain();
                $domain->name = $new_domain;
                $politician->domains()->save($domain);
            }
        }
        if(isset($request->updates['link']) && $request->updates['link'] != ""){
            $link = new Link();
            $link->url = $request->updates['link'];
            $politician->links()->save($link);
        }         

        return ['success' => true];
    }

    public static function modifyPolitician($request,$contact)
    {
    	$politician = Politician::where('id','=',$request->updates['id'])->first();
    	$politician->position = $request->updates['position'];
    	$politician->intersections_at_events = $request->updates['intersections_at_events'];
    	$politician->known_for = $request->updates['known_for'];
    	$politician->reasonability_rating = $request->updates['reasonability_rating'];
    	$politician->openness_rating = $request->updates['openness_rating'];
    	$politician->liason = $request->updates['liason'];

    	$politician->update();

        //Adaugam domenii noi
        if(isset($request->updates['domains_of_interest'])){
            foreach ($request->updates['domains_of_interest'] as $new_domain) {
                $found = false;
                foreach ($politician->domains as $old_domain) {
                    if($old_domain['name'] == $new_domain){
                        $found = true;
                    }
                }
                if($found == false){
                    $domain = new Domain();
                    $domain->name = $new_domain;
                    $politician->domains()->save($domain);
                }
            }
        }

        //Stergem domenii
        foreach ($politician->domains as $old_domain){
            $found = false;
            if(isset($request->updates['domains_of_interest'])){
                foreach ($request->updates['domains_of_interest'] as $new_domain){
                    if($old_domain['name'] == $new_domain){
                        $found = true;
                    }                    
                }
            }
            if($found == false){
                $old_domain->delete();
            }
        }

        //Adaugam link nou
        if(isset($request->updates['new_link']) && $request->updates['new_link'] != ""){
            $link = new Link();
            $link->url = $request->updates['new_link'];
            $politician->links()->save($link);
        }	

        //Stergem/update link-uri 
        if(isset($request->updates['links'])){
            foreach ($request->updates['links'] as $new_link) {
                if($new_link['link'] == ""){
                    Link::where('id','=',$new_link['id'])->first()->delete();
                }else{
                    $modified_link = Link::where('id','=',$new_link['id'])->first();
                    $modified_link->url = $new_link['link'];
                    $modified_link->update();
                }
            }
        }

        if(isset($request->updates['new_partie_name']) && $request->updates['new_partie_name'] != ""){
        	$start_date_month = $request->updates['new_partie_start_date']['month'];
        	$start_date_year = $request->updates['new_partie_start_date']['year'];
        	$start_date_day = $request->updates['new_partie_start_date']['day'];
			$start_date = date("Y-m-d", mktime(0, 0, 0, $start_date_month, $start_date_day, $start_date_year));

        	$end_date_month = $request->updates['new_partie_end_date']['month'];
        	$end_date_year = $request->updates['new_partie_end_date']['year'];
        	$end_date_day = $request->updates['new_partie_end_date']['day'];
			$end_date = date("Y-m-d", mktime(0, 0, 0, $end_date_month, $end_date_day, $end_date_year));	

			$partie = new Partie();
			$partie->name = $request->updates['new_partie_name'];
			$partie->from = $start_date;
			$partie->until = $end_date;

			$politician->parties()->save($partie);

        }	        


        return ['success' => true];      
    }

    public static function modifyPartie($request,$contact)
    {
    	$partie = Partie::where('id','=',$request->updates['id'])->first();
    	
    	$start_date_month = $request->updates['partie_start_date']['month'];
    	$start_date_year = $request->updates['partie_start_date']['year'];
    	$start_date_day = $request->updates['partie_start_date']['day'];
		$start_date = date("Y-m-d", mktime(0, 0, 0, $start_date_month, $start_date_day, $start_date_year));

    	$end_date_month = $request->updates['partie_end_date']['month'];
    	$end_date_year = $request->updates['partie_end_date']['year'];
    	$end_date_day = $request->updates['partie_end_date']['day'];
		$end_date = date("Y-m-d", mktime(0, 0, 0, $end_date_month, $end_date_day, $end_date_year));	

		$partie->name = $request->updates['partie_name'];
		$partie->from = $start_date;
		$partie->until = $end_date;  

		$partie->update();

		return ['success' => true]; 

    }

    public static function deletePartie($request,$contact)
    {
    	$partie = Partie::where('id','=',$request->partie_id)->first();
    	$partie->delete();

		return ['success' => true];    	
    }

	public static function deletePolitician($request,$contact)
	{
		$politician = Politician::where('id','=',$request->politician_id)->first();

        if(isset($politician->parties)){
            foreach ($politician->parties as $partie){
                $partie->delete();
            }                
        }

        $politician->delete();

    	return ['success' => true];		
	}    
}
