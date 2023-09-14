<?php

namespace App\Http\Controllers;

use App\Models\departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    public function saveDepartement(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'libelle' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }    
                $departement= new departement();
                $departement->libelle=$request->input('libelle');
                $departement->save();
            return response()->json(['message' => 'departement submitted successfully'], 201);
        }
}
