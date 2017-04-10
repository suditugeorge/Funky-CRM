<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Volunteer;
use Illuminate\Http\Request;

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
            'first_name' => 'required|',
            'last_name' => 'required',
            'email' => 'required|unique:contacts,email',
            'observations' => 'required',
        ]);
        $contact = Contact::create(request()->only('first_name', 'last_name', 'email', 'secondary_email', 'phone', 'facebook_profile', 'facebook_page', 'website', 'observations'));
        $volunteer = new Volunteer($request->only('availability', 'rating'));
        $contact->volunteer()->save($volunteer);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $volunteer = Volunteer::find($id);
        return view('volunteers.edit', compact($volunteer));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
