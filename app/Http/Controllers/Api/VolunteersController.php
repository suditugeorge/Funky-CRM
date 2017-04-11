<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Request;
use Response;

class VolunteersController extends Controller
{
    public function index()
    {
        $field = Request::get('field');
        $value = Request::get('value');
        if ($field) {
            if (in_array($field, ['first_name', 'last_name', 'email', 'secondary_email', 'phone', 'facebook_profile', 'facebook_page', 'website', 'observations'])) {
                $volunteers = Volunteer::whereHas('contact', function ($query) use ($field, $value) {
                    $query->where($field, $value);
                })->with('contact')->get();
            } else if (in_array($field, ['availability', 'rating'])) {
                $volunteers = Volunteer::with('contact')->where($field, $value)->get();
            }
        } else {
            $volunteers = Volunteer::with('contact')->get();
        }
        return Response::json($volunteers, 200);
    }
}
