<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Excel;

class ExportController extends Controller
{
    public function export($entity, $format)
    {
        $contacts = $this->buildQuery($entity)->toArray();
        $contacts = $this->flattenResults($contacts, $entity);
        dd($contacts);
        Excel::create('Export', function ($excel) use ($contacts, $entity) {
            $excel->sheet(ucfirst($entity), function ($sheet) use ($contacts) {
                $sheet->fromArray($contacts);
            });
        })->download($format);
    }

    private function buildQuery($entity)
    {
        $contacts = Contact::query();
        if ($entity == 'volunteers') {
            $contacts->with('volunteer')->whereHas('volunteer');
        }
        switch ($entity) {
            case 'volunteers':
                $contacts->with('volunteer')->whereHas('volunteer');
                break;
            case 'media':
                $contacts->with('media')->whereHas('media');
                break;
            case 'donors':
                $contacts->with('donor')->whereHas('donor');
                break;
            case 'politicians':
                $contacts->with('politician')->whereHas('politician');
                break;
            case 'colaborators':
                $contacts->with('colaborator')->whereHas('colaborator');
                break;
            case 'employees':
                $contacts->with('employee')->whereHas('employee');
                break;
            default:
                # code...
                break;
        }
        return $contacts->get();
    }

    private function flattenResults($results, $entity)
    {
        foreach ($results as $key => $result) {
            $results[$key] = array_dot($result);
        }
        return $results;
    }
}
