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
use App\Models\Politician;
use App\Models\Media;
use App\Models\Employee;
use App\Models\Donor;
use App\Models\Colaborator;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\DonnerController;
use App\Http\Controllers\PoliticianController;
use App\Http\Controllers\ColaboratorController;
use App\Http\Controllers\EmployeeController;

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

        $volunteers_count = Volunteer::count();
        $media_count = Media::count();
        $donors_count = Donor::count();
        $colaborator_count = Colaborator::count();
        $employee_count = Employee::count();
        $politicians_count = Politician::count();
        $contacts_count = Contact::count();

        $contacts = Contact::orderBy('id', 'asc')->paginate(15);

        return view('dashboard/users',[
            'user' => Auth::user(),
            'volunteers_count' => $volunteers_count,
            'media_count' => $media_count,
            'donors_count' => $donors_count,
            'colaborator_count' => $colaborator_count,
            'employee_count' => $employee_count,
            'politicians_count' => $politicians_count,
            'contacts_count' => $contacts_count,
            'contacts' => $contacts
            ]);
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

    public static function getUsers()
    {
        $users = User::where('is_admin','=',0)->get();
        $users_def = [];
        foreach ($users as $user) {
            $users_def[$user->id] = ['id'=>$user->id,'name'=>$user->name];
        }
        return $users_def;
    }


    public function editCitizenView(Request $request,$id)
    {

        $contact = Contact::with('volunteer','media','donor','politician','colaborator','employee')->where('id','=',$id)->first();

        $users = User::where('is_admin','=',0)->get();

        return view('edit-citizen/edit-citizen',['user' => Auth::user(),'contact' => $contact,'users' => $users]);

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

            $response = ['success'=>true];
        }

        //Daca este inserat un nou voluntariat
        if(isset($request->new_volunteer) && $request->new_volunteer = true){
            $response = VolunteersController::addVolunteer($request,$contact); 
        }

        //Daca se modifica un voluntariat
        if(isset($request->modify_volunteer) && $request->modify_volunteer = true){
            $response = VolunteersController::modifyVolunteer($request,$contact);
        }

        //Daca se sterge un voluntar
        if(isset($request->delete_volunteer) && $request->delete_volunteer == true){
            $response = VolunteersController::deleteVolunteer($request,$contact);
        }

        //Daca este inserat un nou media
        if(isset($request->new_media) && $request->new_media == true){
            $response = MediaController::addMedia($request,$contact);
        }

        //Daca se modifica un media
        if(isset($request->modify_media) && $request->modify_media == true){
            $response = MediaController::modifyMedia($request,$contact);
        }

        //Daca se sterge un media
        if(isset($request->delete_media) && $request->delete_media == true){
            $response = MediaController::deleteMedia($request,$contact);
        }

        //Daca se adauga un donator
        if(isset($request->new_donor) && $request->new_donor == true){
            $response = DonnerController::addDoner($request,$contact); 
        }

        //Daca se modifica un donator
        if(isset($request->modify_donor) && $request->modify_donor == true){
            $response = DonnerController::modifyDonor($request,$contact);
        }

        //Daca se modifica o donatie
        if(isset($request->modify_donation) && $request->modify_donation == true){
            $response = DonnerController::modifyDonation($request,$contact);
        }

        //Daca se sterge o donatie
        if(isset($request->delete_donation) && $request->delete_donation == true){
            $response = DonnerController::deleteDonation($request,$contact);
        }   

        //Daca se sterge un donator
        if(isset($request->delete_donor) && $request->delete_donor == true){
            $response = DonnerController::deleteDoner($request,$contact);
        }     

        //Daca se adauga un politician
        if(isset($request->new_politician) && $request->new_politician == true){
            $response = PoliticianController::addPolitician($request,$contact); 
        }                 

        //Daca se modifica un politician
        if(isset($request->modify_politician) && $request->modify_politician == true){
            $response = PoliticianController::modifyPolitician($request,$contact);
        }          

        //Daca se modifica un partid
        if(isset($request->modify_partie) && $request->modify_partie == true){
            $response = PoliticianController::modifyPartie($request,$contact);
        }    

        //Daca se sterge un partid
        if(isset($request->delete_partie) && $request->delete_partie == true){
            $response = PoliticianController::deletePartie($request,$contact);
        }     

        //Daca se sterge un politician
        if(isset($request->delete_politician) && $request->delete_politician == true){
            $response = PoliticianController::deletePolitician($request,$contact);
        }     

        //Daca se adauga un colaborator
        if(isset($request->new_colaborator) && $request->new_colaborator == true){
            $response = ColaboratorController::addColaborator($request,$contact); 
        }    

        //Daca se modifica un colaborator
        if(isset($request->modify_colaborator) && $request->modify_colaborator == true){
            $response = ColaboratorController::modifyColaborator($request,$contact);
        }          

        //Daca se sterge un colaborator
        if(isset($request->delete_colaborator) && $request->delete_colaborator == true){
            $response = ColaboratorController::deleteColaborator($request,$contact);
        }            

        //Daca se adauga un funcționar
        if(isset($request->new_employee) && $request->new_employee == true){
            $response = EmployeeController::addEmployee($request,$contact); 
        }   

        //Daca se modifica un functionar
        if(isset($request->modify_employee) && $request->modify_employee == true){
            $response = EmployeeController::modifyEmployee($request,$contact);
        }    

        //Daca se modifica o instituție
        if(isset($request->modify_institution) && $request->modify_institution == true){
            $response = EmployeeController::modifyInstitution($request,$contact);
        }                     

        //Daca se sterge o instituție
        if(isset($request->delete_institution) && $request->delete_institution == true){
            $response = EmployeeController::deleteInstitution($request,$contact);
        }  

        //Daca se sterge un funcționar
        if(isset($request->delete_employee) && $request->delete_employee == true){
            $response = EmployeeController::deleteEmployee($request,$contact);
        }        
                 

        return response()->json($response);

    }

}
