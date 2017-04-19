<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Response;
use App\Models\Attendance;
use App\Models\Domain;
use App\Models\Skill;

class VolunteersController extends Controller
{

    public static function addVolunteer($request,$contact)
    {
        try{
            $volunteer = new Volunteer();
            $volunteer->rating = $request->rating;
            $volunteer->availability = $request->availability;

            $contact->volunteer()->save($volunteer);
            if(isset($request->event_name) && $request->event_name != ""){
                $attendance = new Attendance();
                $attendance->event = $request->event_name;
                $attendance->details = $request->event_details;

                $volunteer->attends()->save($attendance);

            }

            if(isset($request->domains_of_interest) && $request->domains_of_interest != ""){
                foreach ($request->domains_of_interest as $new_domain) {
                    $domain = new Domain();
                    $domain->name = $new_domain;
                    $volunteer->domains()->save($domain);
                }
            }

            if(isset($request->skills) && $request->skills !=""){
                foreach ($request->skills as $new_skill) {
                    $skill = new Skill();
                    $skill->name = $new_skill;
                    $volunteer->skills()->save($skill);

                }
            }
            return ['success' => true];
        }catch(\Exception $e){
            return [
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ];
        }

    }

    public static function modifyVolunteer($request,$contact)
    {
        try{

            $volunteer = Volunteer::where('id','=',$request->updates['id'])->first();
            $volunteer->availability = $request->updates['availability'];
            $volunteer->rating = $request->updates['rating'];
            $volunteer->update();

            //Adaugăm skill-uri noi
            if(isset($request->updates['skills'])){
                foreach ($request->updates['skills'] as $new_skill) {
                    $found = false;
                    foreach ($volunteer->skills as $old_skill) {
                        if($old_skill['name'] == $new_skill){
                            $found = true;
                        }
                    }
                    if($found == false){
                        $skill = new Skill();
                        $skill->name = $new_skill;
                        $volunteer->skills()->save($skill);                    
                    }
                }                
            }

            //Stergem skill-uri 
            foreach ($volunteer->skills as $old_skill) {
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
                    foreach ($volunteer->domains as $old_domain) {
                        if($old_domain['name'] == $new_domain){
                            $found = true;
                        }
                    }
                    if($found == false){
                        $domain = new Domain();
                        $domain->name = $new_domain;
                        $volunteer->domains()->save($domain);
                    }
                }
            }

            //Stergem domenii
            foreach ($volunteer->domains as $old_domain){
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

            //Adaugam/stergem eveniment
            if(isset($request->updates['event_name'])){
                if(!isset($volunteer->attends[0])){
                    $attendance = new Attendance();
                    $attendance->event = $request->updates['event_name'];
                    $attendance->details = @$request->updates['event_details'];
                }else{
                    $volunteer->attends[0]->event = $request->updates['event_name'];
                    $volunteer->attends[0]->details = @$request->updates['event_details'];
                    $volunteer->attends[0]->update();
                }
            }elseif(isset($volunteer->attends[0])){
                $volunteer->attends[0]->delete();
            }
            return ['success' => true];
        }catch(\Exception $e){
            return [
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ];
        }

    }

    public static function deleteVolunteer($request,$contact)
    {
        try {
            $volunteer = Volunteer::where('id','=',$request->id)->first();

            if(isset($volunteer->attends[0])){
                $volunteer->attends[0]->delete();
            }
            if(isset($volunteer->domains)){
                foreach ($volunteer->domains as $old_domain){
                    $old_domain->delete();
                }                
            }
            if(isset($volunteer->skills)){
                foreach ($volunteer->skills as $old_skill) {      
                    $old_skill->delete();
                }          
            }

            $volunteer->delete();
            return ['success' => true];
        }catch(\Exception $e) {
            return [
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ];            
        }
    }

    public function index()
    {
        $volunteers = Volunteer::paginate(5);
        return view('volunteers.index', compact('volunteers'));
    }

    public function create()
    {
        return view('volunteers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:contacts,email',
            'observations' => 'required',
        ]);
        $contact = Contact::create(request()->only('first_name', 'last_name', 'email', 'secondary_email', 'phone', 'facebook_profile', 'facebook_page', 'website', 'observations'));
        $volunteer = new Volunteer($request->only('availability', 'rating'));
        $contact->volunteer()->save($volunteer);
        return redirect()->route('volunteers.index');
    }


    public function edit($id)
    {
        $volunteer = Volunteer::with('contact')->where('id', $id)->first();
        return view('volunteers.edit', compact('volunteer'));
    }

    public function update(Request $request, $id)
    {
        $volunteer = Volunteer::with('contact')->where('id', $id)->first();
        $this->validate($request, [
            'contact.first_name' => 'required',
            'contact.last_name' => 'required',
            'contact.email' => "required|unique:contacts,email,{$volunteer->contact->id}",
            'contact.observations' => 'required',
        ]);
        $volunteer->update(array_only(request()->all(), ['availability', 'rating']));
        $volunteer->contact->update(array_only($request->all()['contact'], ['first_name', 'last_name', 'email', 'secondary_email', 'phone', 'facebook_profile', 'facebook_page', 'website', 'observations']));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $volunteer = Volunteer::find($id);
        $volunteer->delete();
        $volunteer->contact()->delete();
        return Response::json([
            'message' => 'succes',
        ], 200);
    }
}
