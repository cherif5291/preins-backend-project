<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\postulation;
use App\Models\classe;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
//     public function __construct()
// {
//     $this->middleware(['role:super-admin']);
// }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        // Vérifier si l'utilisateur est authentifié
   
        // Obtenir l'utilisateur actuellement authentifié
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a des rôles
        return response()->json($user = Auth::user());

}

    public function logoutOtherDevices()
    {
        $user = Auth::user();
        $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();
    
        return response()->json(['message' => 'Other devices logged out.']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listerPostulation()
    {
        $postulation=postulation::all();
        return $postulation;
    }

    public function mesPostulations(){
        $user = Auth::user();
        $postulations = Postulation::where("postulant_id", $user->id)->get();
        // $classe=  $postulations->classe->libelle;

        return response()->json($postulations);
    }
    public function logout(Request $request)
{
    $user = Auth::user();
    $user->tokens()->delete(); // Révoque tous les jetons de l'utilisateur

    $response = [
        'success' => true,
        'data' => null,
        'message' => 'Logged out successfully'
    ];

    return response()->json($response);
}

public function addUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'prenom' => 'required',
        'email' => 'required',
        'role_id' => 'required',
        'password' => 'required',
        'c_password' => 'required|same:password',
    ]);
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }    
        $user= new User();
        $user->name=$request->input('name');
        $user->prenom=$request->input('prenom');
        $user->email=$request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $role = Role::findOrFail($request->input('role_id'));
        // Assign the role to the user
        $user->assignRole($role);
        return response()->json(['message' => 'User submitted successfully'], 201);

}

public function Verifier($id)

    {
        $postulation = Postulation::find($id);
        $postulation->status = "Postulation vérifié et en attente de validation";
        $postulation->update();
        return response()->json(['message' => 'Postulation vérifié successfully'], 201);   
    }
    public function valider($id)

    {
        $postulation = Postulation::find($id);
        $postulation->status = "Postulation vérifié et en attente de validation";
        $postulation->update();
        return response()->json(['message' => 'Postulation validé (vous etes admis(e))'], 201);   
    }

    public function refuser($id)

    {
        $postulation = Postulation::find($id);
        if($postulation){
        $postulation->status = "Demande d'admission rejeté ";
        $postulation->update();
        return response()->json(['message' => 'Postulation rejeté'], 201); 
        }else{
                return response()->json(['message' => 'Postulation n\'existe pas'], 201);
        }  
    }

    public function incomplet($id)

    {
        $postulation = Postulation::find($id);
        if($postulation){
        $postulation->status = "Documents incomplet (Rejeté)";
        $postulation->update();
        return response()->json(['message' => 'Postulation rejeté car incomplet'], 201); 
        }else{
                return response()->json(['message' => 'Postulation n\'existe pas'], 201);
        }  
    }

    public function listeRole()
    {
        $role=DB::table('roles')->get();
        return response()->json($role);
    }

    public function listeUser()
    {
        $users=User::with('roles')->get();
        return response()->json($users);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

        /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
