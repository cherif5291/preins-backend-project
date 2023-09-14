<?php

namespace App\Http\Controllers;

use App\Models\postulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostulationController extends Controller
{
    public function postuler(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'classe_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }    
                $postulation= new postulation();
                $postulation->classe_id=$request->input('classe_id');
                $postulation->postulant_id=Auth::user()->id;
                $postulation->status="Envoyé";
                $postulation->save();
            return response()->json(['message' => 'Postulation submitted successfully'], 201);
        }
}
