<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Colaborator;
use App\Models\Donor;
use App\Models\Employee;
use App\Models\Media;
use App\Models\Politician;
use Response;

class ContactsController extends Controller
{
    public function media()
    {
        $media = Media::with('contact')->get();
        return Response::json($media, 200);
    }

    public function donors()
    {
        $donors = Donor::with('contact')->get();
        return Response::json($donors, 200);
    }

    public function politicians()
    {
        $politicians = Politician::with('contact')->get();
        return Response::json($politicians, 200);
    }

    public function colaborators()
    {
        $colaborators = Colaborator::with('contact')->get();
        return Response::json($colaborators, 200);
    }

    public function employees()
    {
        $employees = Employee::with('contact')->get();
        return Response::json($employees, 200);
    }

}
