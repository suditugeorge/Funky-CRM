<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Response;

class VolunteersController extends Controller
{
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

    public function show($id)
    {
        //
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
            'contact.email' => "quired|unique:contacts,email,{$volunteer->contact->id}",
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
