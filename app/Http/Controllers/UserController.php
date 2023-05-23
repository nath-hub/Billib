<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail; 
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;


class UserController extends Controller
{
    
    
    public function index(Request $request)
    {
         $ip = $request->ip(); /*Dynamic IP address */
       // $ip = '103.239.147.187'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
          return $currentUserInfo;
        // return view('user', compact('currentUserInfo'));
    }
    
    
    /**
 * Class User.
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
    
    public function register(Request $request)
    {
        
         /**
     * @OA\Post(
     *      path="/public/index.php/api/register",
     *      operationId="register",
     *      tags={"User"},
     *      summary="Register",
     *      description="Register",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="name", type="string", format="string", example="nathalie", description ="votre nom"),
     *       @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *      @OA\Property(property="password", type="string", format="string", example="sdms", description ="votre password"),
     *      @OA\Property(property="code_postal", type="string", format="string", example="123456", description ="votre code_ ostal"),
     *            )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Utilisateur bien Creer."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
        
        $regle = array(
            'name'=>'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'code_postal' => 'required|string'
        );
        $validator = Validator::make($request->all(), $regle);
        
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        };
        
        //  $verify = random_int(100000, 999999);
        
      
        
        $user = new User();
        $user->name = $request ->name;
        $user->email = $request ->email;
        $user->password = Hash::make($request ->password);
        $user->code_postal = $request ->code_postal;
        $rep = $user -> save();
         
        
        $id = $user->id;
        
         $mail = Mail::send('mail', ['verify' => $id], function($message) use($request){
              $message->to($request->email);
              $message->subject("E-mail de validation");
        });
        
        
        if($rep){
            
             $token = $user->createToken('auth_token')->plainTextToken;
          
            $user = User::findOrFail($id);
        	$user->token = $token;
        	$upUser = $user->update();
            
            
            
              return response()->json([
                'msg' => 'Utilisateur est bien crée',
                'status_code' => 201,
                'user' => $user,
                ]); 
        }else {
            return ['msg'=>'echec'];
        };
    }
    
      /**
     * @OA\Get(
     *     path="/public/index.php/api/GetUser/{id}",
     *      operationId="show",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Get User",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     * 
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    
    
    
    public function show(Request $request, $id)
        {
            $user = User::findOrFail($id);
            return $user;
        }
        
        
     /**
     * @OA\Put(
     *      path="/public/index.php/api/UpdateVerifiedEmail/{id}",
     *      operationId="VerifyEmail",
     *      tags={"User"},
     *      summary="Verification d'email",
     *      description="Verification d'email",
     *     

     * 
     *		@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ),
     *       @OA\Response(
     *      response=200,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Modification d'un utilisateur réussi."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
        
        
  
  public function VerifyEmail(Request $request, $id){
    
    		$verify = random_int(100000, 999999);
    
    		$user = User::findOrFail($id);
    
    		$mail = Mail::send('confirmationEmail', ['verify' => $verify], function($message) use($request){
              $message->to($user->email);
              $message->subject("E-mail de vérification");
        	});
    
   	 		
            $user->validation = $verify;
            $upUser = $user->update();
            return ["statut"=>200, "data"=>$user];
        
  }
    
    
    /**
     * @OA\Put(
     *      path="/public/index.php/api/updateCode/{id}",
     *      operationId="modifierCode",
     *      tags={"User"},
     *      summary="code pour scanner",
     *      description="code pour scanner",
     *     

     * 
     *		@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ),
      *  @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"code"},
     *            @OA\Property(property="code", type="string", format="string", example="yt5e4w"),
     *         ),
     *      ),
     *       @OA\Response(
     *      response=200,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Modification d'un utilisateur réussi."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    
    
    
    
    
      public function modifierCode(Request $request, $id){
         $regle = array(
            'code' => 'required|string|min:6|max:6'
        );
        $validator = Validator::make($request->all(), $regle);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        };
        
        $user = User::findOrFail($id);
        if ($user->code == null){
            $user->code = $request->code;
            $upUser = $user->update();
            return ["statut"=>200, "data"=>$user];
        }else if($user->code == $request->code){
            return ["statut"=>200, "data"=>$user];
        }else{
          return ["statut"=>400, "message"=>"mauvais code"];
        }
        
    }
    
    
    
    
      /**
     * @OA\Put(
     *      path="/public/index.php/api/updatePassword/{id}",
     *      operationId="modifierPassword",
     *      tags={"User"},
     *      summary="mettre a jour le mot de passe",
     *      description="mettre a jour le mot de passe",
     *     

     * 
     *		@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ),
      *  @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"code"},
     *            @OA\Property(property="password", type="string", format="string", example="yt5e4w"),
     *         ),
     *      ),
     *       @OA\Response(
     *      response=200,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Modification d'un utilisateur réussi."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    
    
    
    
     public function modifierPassword(Request $request, $id){
         $regle = array(
            'password' => 'required|string|min:6|max:6'
        );
        $validator = Validator::make($request->all(), $regle);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        };
        
        $user = User::findOrFail($id);
        if ($user->code !== null){
            $user->password = $request->password;
            $upUser = $user->update();
            return ["statut"=>200, "data"=>$user];
        }else{
          return ["statut"=>400, "message"=>"Utilisateur n'existe pas"];
        }
        
    }
    
      
    
    
    
    
    //le code qui est comme le mot de passe
    public function UpdateCode(Request $request, $id){
        
        $random = random_int(100000000, 999999999);
        
        $identifiant = "33" . $random;
         
        $user = User::findOrFail($id);
        $user->identifiant = $identifiant;
        $upUser = $user->update(); 
        
        if ($upUser){
          return view('page', ['identifiant' => $identifiant]);
        }
        
    
    
    
       /**
     * @OA\Post(
     *      path="/public/index.php/api/login",
     *      operationId="login",
     *      tags={"User"},
     *      summary="Login",
     *      description="Logim",
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="email or identifiant", type="string", format="string", example="examples@gmail.com", description ="votre email ou identifiant"),
     *  @OA\Property(property="password", type="string", format="string", example="12ddkfd", description ="votre password")
     *            )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Utilisateur bien Connecter."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     *   @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    }
    
    public function login(Request $request)
    {
        
         $regle = array( 
             'email' =>'required_without:identifiant|string|email|exists:users,email',
             'identifiant' => 'required_without:email|string|exists:users,identifiant',
             'password' => 'required',
        );
        $validator = Validator::make($request->all(), $regle);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        };
        
        
        $user = DB::table('users')->where('email', $request->email)->first();
                
        if(!empty($user) && $user->identifiant !== null){
            
            
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json([
                  'msg' => 'Utilisateur connecté',
                  'status_code' => 200,
                  'user' => $user]);
            }else{
                return ['message'=>"email or password incorrect"];
            }
            
            
          
        }else if(empty($user)){
             $users = DB::table('users')->where('identifiant', $request->identifiant)->first();
                    
             if(!empty($users) && $users->identifiant !== null){
                    if(Auth::attempt(['identifiant' => $request->identifiant, 'password' => $request->password])){
                        return response()->json([
                          'msg' => 'Utilisateur connecté',
                          'status_code' => 200,
                          'user' => $users]);
                    }else{
                        return ['message'=>"identifiant or password incorrect"];
                    }
             }else{
                 return response()->json([
                            'msg' => "Utilisateur n'existe pas ou n'a pas verifier son compte",
                            'status_code' => 400,
                        ]);
             }
            
        }else{
                 return response()->json([
                            'msg' => "Utilisateur n'existe pas ou n'a pas verifier son compte",
                            'status_code' => 400,
                        ]);
             }
  
    }
        
    
    
    
    
           /**
     * @OA\Delete(
     *      path="/public/index.php/api/logout/{id}",
     *      operationId="logout",
     *      tags={"User"},
     *      summary="déconnection d'un utilisateur",
     *      description="déconnection d'un utilisateur",
     *     
     *		@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="2",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ),
     * 
     *       @OA\Response(
     *      response=200,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Utilisateur déconnecté."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
     
    
    
    public function logout(Request $request, $id){
        
        $user = User::findOrFail($id);
        $user->token = "";
        $use = $user->update();
        
        if($use){
            return ["vous etes bien deconnecter"];
        };
      
    }
    
}
