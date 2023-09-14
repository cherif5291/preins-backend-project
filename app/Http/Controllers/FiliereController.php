<?php

namespace App\Http\Controllers;

use App\Models\filiere;
use App\Models\classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FiliereController extends Controller
{
    public function saveFiliere(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'libelle' => 'required',
                'departement_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }    
                $filiere= new filiere();
                $filiere->libelle=$request->input('libelle');
                $filiere->departement_id=$request->input('departement_id');
                $filiere->save();
            return response()->json(['message' => 'filiere submitted successfully'], 201);
        }
        public function listeFiliere()
        {
            $Filiere=filiere::all();
            return response()->json($Filiere);
        }

        public function getClasseByFiliere($id)
        {
            $classes = Classe::where('filiere_id', $id)->get();
            
            return response()->json($classes);
        }
}
