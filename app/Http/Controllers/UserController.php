<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Models\Contact;
use App\Models\Volunteer;
use App\Models\Attendance;
use App\Models\Domain;
use App\Models\Skill;

class UserController extends Controller
{
	public function dashboard()
	{
    	$user = Auth::user();
    	//die(print_r($user));

    	return view('dashboard/profile', ['user' => $user]);
	}

    public static function getBasicInfo()
    {
        $user = Auth::user();

		$basic_info = "Acest cont este deținut de un Admin";

        return $basic_info;
    }

    public function changeProfilePhoto(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('profilePicture');

        if(!$file){
            return view('dashboard/profile', ['user' => $user, 'error_message' => "Există o problemă cu fișierul încarcat"]);
        }

        $rules = [
            'file' => 'required | mimes:jpeg,jpg,png ',
        ];
        $validator = Validator::make(['file' => $file], $rules);
        if (!$validator->fails()) {
            $file_name = $user->id . '.jpg';
            Storage::disk('user-profiles')->put($file_name, File::get($file));
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function updateProfile(Request $request)
    {
        try{
            $user = Auth::user();

            $user->name = $request['name'];
            if($request['password'] && trim($request['password']) != ""){
                $user->password = Hash::make($request['password']);
            }
            $user->update();
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ]);               
        }
        return response()->json([
            'success' => true,
        ]); 
    }

    public function searchUsers(Request $request)
    {
        return view('dashboard/users',['user' => Auth::user()]);
    }

    public function addFunkyUser(Request $request)
    {
        if($request->isMethod('get')){
            return view('dashboard/add-funky',['user' => Auth::user()]);
        }

        $request->emails = preg_split('`\s`', $request->emails);
        foreach ($request->emails as $email) {

            $user = new User();
            $user->name = "Utilizator Funky";
            $user->email = $email;
            $password = str_random(8);
            $user->password = Hash::make($password);
            $user->is_admin = 0;
            $user->save();

            $data = ['email' => $email,'password' => $password];

            Mail::send('email-templates.add-admin', $data, function ($m) use ($email) {
                $m->from('i.tconsult99@gmail.com', 'Funcky-Catalog');
                $m->to($email)->subject('Funky-Catalog are nevoie de atenția ta!');
            });
        }
        return response()->json(['success'=>true,'message' => 'Utilizatorii au fost adăugați']);
    
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email','=',$request['email'])->first();
        if($user == NULL){
            return response()->json(['success'=>false,'message' => 'Acest user nu există','field' => 'email']);
        }

        $password = str_random(8);
        $user->password = Hash::make($password);
        $user->update();

        $data = ['email' => $user->email, 'password' => $password];

        Mail::send('email-templates.reset-password', $data, function ($m) use ($user) {
            $m->from('i.tconsult99@gmail.com', 'Funcky-Catalog');
            $m->to($user->email)->subject('Funky-Catalog are nevoie de atenția ta!');
        });

        return response()->json(['success'=>true,'message' => 'A fost trimis un email către adresa respectivă']);

    }

    public function addCitizen(Request $request)
    {
        if($request->isMethod('get')){
            return view('dashboard/add-citizen',['user' => Auth::user()]);
        }
        
        $contact = new Contact();
        $contact->email = $request->email;
        $contact->first_name = $request->nume;
        $contact->last_name = $request->prenume;
        $contact->secondary_email = $request->email2;
        $contact->phone = $request->phone;
        $contact->facebook_profile = $request->facebook_profil;
        $contact->facebook_page = $request->facebook_pagina;
        $contact->website = $request->site;
        $contact->observations = $request->observatii;

        $contact->save();
        $url = '/edit-citizen/'.$contact->id;
        return response()->json(['success'=>true, 'url' => url('/edit-citizen/'.$contact->id)]);
    }

    public function editCitizenView(Request $request,$id)
    {

        $contact = Contact::with('volunteer')->where('id','=',$id)->first();
        //die(print_r($contact->volunteer));
        /*
        foreach ($contact->volunteer as $volunteer) {
            //$attend = $volunteer->attends[0]->event;
            die(print_r($volunteer->domains));
        }
        */

        return view('edit-citizen/edit-citizen',['user' => Auth::user(),'contact' => $contact]);

    }

    public function editCitizen(Request $request)
    {

        $contact_id = $request->contact_id;
        $contact = Contact::where('id','=',$contact_id)->first();

        //Daca sunt editate doar datele de contact
        if(isset($request->basic) && $request->basic = true){
            
            $contact->email = $request->email;
            $contact->first_name = $request->nume;
            $contact->last_name = $request->prenume;
            $contact->secondary_email = $request->email2;
            $contact->phone = $request->phone;
            $contact->facebook_profile = $request->facebook_profil;
            $contact->facebook_page = $request->facebook_pagina;
            $contact->website = $request->site;
            $contact->observations = $request->observatii;
            $contact->update();

            return response()->json(['success'=>true]);

        }

        //Daca este inserat un nou voluntariat
        if(isset($request->new_volunteer) && $request->new_volunteer = true){
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
        }

        //Daca se modifica un voluntariat
        if(isset($request->modify_volunteer) && $request->modify_volunteer = true){
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
            

        }
        return response()->json(['success'=>true]);
    }

}
