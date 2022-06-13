<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    //
    public function search(Request $request)
    {
        $search = $request->get('term');
        $result = Entity::select('title')
            ->where('title', 'like', '%' . $search . '%')
            ->get();


        $dataModified = array();
        foreach ($result as $data) {
            $dataModified[] = $data->title;
        }
        return response()->json($dataModified);

//        return response()->json($result);
    }
}
