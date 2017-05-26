<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Colaborator;
use App\Models\Domain;
use App\Models\Skill;

class ColaboratorController extends Controller
{
	public static function addColaborator($request,$contact)
	{
		$colaborator = new Colaborator();
		$colaborator->availability = $request->availability;
		$colaborator->keyword = $request->keyword;

		$contact->colaborator()->save($colaborator);

        if(isset($request->domains_of_interest) && $request->domains_of_interest != ""){
            foreach ($request->domains_of_interest as $new_domain) {
                $domain = new Domain();
                $domain->name = $new_domain;
                $colaborator->domains()->save($domain);
            }
        }

        if(isset($request->skills) && $request->skills !=""){
            foreach ($request->skills as $new_skill) {
                $skill = new Skill();
                $skill->name = $new_skill;
                $colaborator->skills()->save($skill);

            }
        } 

        return ['success' => true];       		
	}

	public static function modifyColaborator($request,$contact)
	{
		$colaborator = Colaborator::where('id','=',$request->updates['id'])->first();
        $colaborator->availability = $request->updates['availability'];
        $colaborator->keyword = $request->updates['keyword'];

        $colaborator->update();		

        //Adaugăm skill-uri noi
        if(isset($request->updates['skills'])){
            foreach ($request->updates['skills'] as $new_skill) {
                $found = false;
                foreach ($colaborator->skills as $old_skill) {
                    if($old_skill['name'] == $new_skill){
                        $found = true;
                    }
                }
                if($found == false){
                    $skill = new Skill();
                    $skill->name = $new_skill;
                    $colaborator->skills()->save($skill);                    
                }
            }                
        }

        //Stergem skill-uri 
        foreach ($colaborator->skills as $old_skill) {
            $found = false;
            if(isset($request->updates['skills'])){
                foreach ($request->updates['skills'] as $new_skill){
                    if($old_skill['name'] == $new_skill){
                        $found = true;
                    }                    
                }
            }
            if($found == false){
                $old_skill->delete();                 
            }                
        }  
        
        //Adaugam domenii noi
        if(isset($request->updates['domains_of_interest'])){
            foreach ($request->updates['domains_of_interest'] as $new_domain) {
                $found = false;
                foreach ($colaborator->domains as $old_domain) {
                    if($old_domain['name'] == $new_domain){
                        $found = true;
                    }
                }
                if($found == false){
                    $domain = new Domain();
                    $domain->name = $new_domain;
                    $colaborator->domains()->save($domain);
                }
            }
        }

        //Stergem domenii
        foreach ($colaborator->domains as $old_domain){
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
        
        return ['success' => true];             
	}

	public static function deleteColaborator($request,$contact)
	{
		$colaborator = Colaborator::where('id','=',$request->colaborator_id)->first();
        if(isset($colaborator->domains)){
            foreach ($colaborator->domains as $old_domain){
                $old_domain->delete();
            }                
        }
        if(isset($colaborator->skills)){
            foreach ($colaborator->skills as $old_skill) {      
                $old_skill->delete();
            }          
        }

        $colaborator->delete();
        return ['success' => true];		
	}
}
