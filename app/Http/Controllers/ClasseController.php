<?php

namespace App\Http\Controllers;

use App\Models\classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClasseController extends Controller
{
    public function saveClasse(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'libelle' => 'required',
                'filiere_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }    
                $classe= new classe();
                $classe->libelle=$request->input('libelle');
                $classe->filiere_id=$request->input('filiere_id');
                $classe->save();
                return response()->json(['message' => 'Classe submitted successfully'], 201);

        }

        public function listeClasse()
        {
            $classe=classe::all();
            return response()->json($classe);
        }
        
}
