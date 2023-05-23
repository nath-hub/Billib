<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Article;
use App\Models\Lienjson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;


class TicketController extends Controller
{
   
   
   
   
 
    public function AddTicket(Request $request, $id)
    {
        
        
    /**
     * @OA\Post(
     *      path="/public/index.php/api/AddTicket",
     *      operationId="AddTicket",
     *      tags={"Ticket"},
     *      summary="Ticket",
     *      description="Ticket",
    
     * @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"user_id","nom_magasin, telephone, numero, adresse, caissiere,net, tva total_payer, data"},
     *  @OA\Property(property="user_id", type="number", format="int", example="1", description ="identifiant de l'utilisateur"),
     *            @OA\Property(property="nom_magasin", type="string", format="string", example="nathalie", description ="votre nom"),
     *       @OA\Property(property="telephone", type="number", format="int", example="1", description ="votre phone"),
     *      @OA\Property(property="numero", type="number", format="string", example="1", description ="votre email de recuperation"),
     *     @OA\Property(property="adresse", type="string", format="string", example="nathalie", description ="adresse"),
     *       @OA\Property(property="caissiere", type="string", format="int", example="example", description ="caissiere"),
     *      @OA\Property(property="net", type="number", format="int", example="9100", description ="net"),
     *      @OA\Property(property="tva", type="number", format="int", example="900", description ="tva"),
     *      @OA\Property(property="total_payer", type="number", format="string", example="100000", description ="total_payer"),
     *    
     *     
     *      
     * @OA\Property(
     *          property="datas",
     *          type="array",
     *              example={
     *                   {
     *                       "nom": "macabo",
     *                       "quantite": 23,
     *                       "pu": 2100,
     *                       "montant": "145000",
     *                       "categories": null,
     *                       "total": 500000,
     *                       "notice": "https://meet.google.com/",
     *                       "noticeDoc": "https://meet.google.com/",
     *                       "garantie": "https://meet.google.com/",
     *                       "tuto": "https://meet.google.com/", 
     *                       "reparation": "https://meet.google.com/", 
     *                       "autreModele": "https://meet.google.com/", 
     *                       "revente": "https://meet.google.com/"
     *                   },
     *                   {
     *                       "nom": "arachide",
     *                       "quantite": 15,
     *                       "pu": 2100,
     *                       "montant": "14500",
     *                       "categories": null,
     *                       "total": 100000,
     *                       "notice": "https://meet.google.com/",
     *                       "noticeDoc": "https://meet.google.com/",
     *                       "garantie": "https://meet.google.com/",
     *                       "tuto": "https://meet.google.com/", 
     *                       "reparation": "https://meet.google.com/", 
     *                       "autreModele": "https://meet.google.com/", 
     *                       "revente": "https://meet.google.com/"
     *                   }},
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="organization",
     *                      type="string",
     *                      example="1"
     *                  ),
     *                  @OA\Property(
     *                      property="site",
     *                      type="string",
     *                      example="1"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      example="Test Title"
     *                  ),
     *                  @OA\Property(
     *                      property="affiliate",
     *                      type="string",
     *                      example="1"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string",
     *                      example="Description body"
     *                  ),
     *                  @OA\Property(
     *                      property="reported_by",
     *                      type="string",
     *                      example="User Name"
     *                  ),
     *                  @OA\Property(
     *                      property="discovered",
     *                      type="string",
     *                      example="2022-10-03"
     *                  ),
     *                  @OA\Property(
     *                      property="type",
     *                      type="string",
     *                      example="1"
     *                  ),
     *                  @OA\Property(
     *                      property="affected",
     *                      type="boolean",
     *                      example="true"
     *                  ),
     *                  @OA\Property(
     *                      property="active",
     *                      type="boolean",
     *                      example="true"
     *                  ),
     *                  @OA\Property(
     *                      property="reason",
     *                      type="string",
     *                      example=""
     *                  ),
     *                  @OA\Property(
     *                      property="regulatory_act",
     *                      type="string",
     *                      example="HIPAA"
     *                  ),
     *                  @OA\Property(
     *                      property="investigating",
     *                      type="boolean",
     *                      example="true"
     *                  ),
     *                
     *              ),
     *      ),
     * ),
     * ),
     * 
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="ticket bien Creer."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     )
     * 
     *      
     * )
     */
        
        
          
        $regle = array(
            'nom_magasin'=>'required|string',
            'telephone' => 'required|string',
            'adresse' => 'required|string',
            'caissiere' => 'required|string',
            'total_payer' => 'required',
            'datas'=>'required|array',
            'net'=>'required',
            'tva'=>'required',
            'numero'=>'required|unique:tickets'
            
        );
        $validator = Validator::make($request->all(), $regle);
        
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        };
        
        $tiket = new Ticket();
        $tiket->nom_magasin = $request ->nom_magasin;
        $tiket->telephone = $request ->telephone;
        $tiket->numero = $request ->numero;
         $tiket->adresse = $request->adresse;
      $tiket->caissiere = $request->caissiere;
      $tiket->net = $request->net;
      $tiket->tva = $request->tva;
        $tiket->user_id = $id;
        $tiket->total_payer = $request ->total_payer;
        $rep = $tiket -> save();
        
        if($rep){
            
            $datas = $request->datas;
            
            
            
             foreach($datas as $data){
                 $article = new Article();
                $article->nomArticle = $data["nomArticle"];
                $article->quantite = $data["quantite"]; 
                $article->pu = $data["pu"]; 
                $article->montant = $data["montant"]; 
                $article->ticket_id = $tiket->id;
                 $article->user_id = $id;
                $article->notice = $data['notice'];
                $article->noticeDoc = $data['noticeDoc'];
                $article->garantie = $data[ 'garantie'];
                $article->tuto = $data[ 'tuto']; 
                $article->reparation = $data[ 'reparation']; 
                $article->autreModele = $data[ 'autreModele']; 
                $article->revente = $data[ 'revente'];
                $dat = $article->save();
             }
            
            return ["statut"=>200, "message"=> "Tickets créé avec succés", "data"=>$article];
        }
        
        
    }

  
  
   /**
     * @OA\Get(
     *     path="/public/index.php/api/Get/{id}",
     *      operationId="show",
     *      tags={"Ticket"},
     *      summary="Get Tikect",
     *      description="Get Tikect",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "article id",
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
     *      @OA\Property(property="message", type="string", example="Affichage des tickets d'un article."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     )
     * )
     *      
     * )
     */
  
  
    public function show($id)
    {
        return $tikect = ArticleResource::collection(Article::where('ticket_id' ,  $id)->get());
    }
    
    
  
   /**
     * @OA\Get(
     *     path="/public/index.php/api/getTicketByUser/{id}",
     *      operationId="getTicketByUser",
     *      tags={"Ticket"},
     *      summary="Get Tikect",
     *      description="Get Tikect",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "article id",
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
     *      @OA\Property(property="message", type="string", example="Affichage des tickets d'un article."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     )
     * )
     *      
     * )
     */
  
  
  
   public function getTicketByUser($id)
    {
        return $tikect = Ticket::where('user_id' ,  $id)->get();
    }
    
   /**
     * @OA\Get(
     *     path="/public/index.php/api/getByUser/{id}",
     *      operationId="getWhereUser",
     *      tags={"Ticket"},
     *      summary="Get Tikect",
     *      description="Get Tikect",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "article id",
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
     *      @OA\Property(property="message", type="string", example="Affichage des tickets d'un article."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     )
     * )
     *      
     * )
     */
  


  public function getWhereUser($id)
    {
        return $tikect = ArticleResource::collection(Article::where('user_id' ,  $id)->get());
    }
   
   
    /**
     * @OA\Put(
     *      path="/public/index.php/api/updateTicket/{id}",
     *      operationId="update",
     *      tags={"Ticket"},
     *      summary="Modifier un ticket",
     *      description="Modifier un ticket",
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
     *           required={"nom_magasin, telephone, numero, adresse, caissiere, total_payer, net, tva"},
     *              @OA\Property(property="nom_magasin", type="string", format="string", example="carrefour"),
     *              @OA\Property(property="telephone", type="number", format="int", example="12231212"),
     *              @OA\Property(property="numero", type="number", format="int", example="122312"),
     *              @OA\Property(property="adresse", type="string", format="string", example="11 france"),
     *              @OA\Property(property="caissiere", type="string", format="string", example="mathile"),
     *              @OA\Property(property="net", type="string", format="string", example="9100"),
     *              @OA\Property(property="tva", type="string", format="string", example="900"),
     *              @OA\Property(property="total_payer", type="number", format="int", example="10000"),
     *         ),
     *      ),
     *       @OA\Response(
     *      response=200,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="ticket modifier avec succes."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     )
     * )
     *      
     * )
     */
    

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        
        $ticket->update($request->all());
        
        return ["statut"=>200, "message"=> "Tickets modifié avec succés", "data"=>$ticket];
    }
    
    
  /**
     * @OA\Delete(
     *      path="/public/index.php/api/destroyTicket/{id}",
     *      operationId="destroy",
     *      tags={"Ticket"},
     *      summary="Suppression d'un ticket",
     *      description="Suppression d'un ticket",
     *     
     *		@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "ticket id",
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
     *      @OA\Property(property="message", type="string", example="ticket supprimer avec succes."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     )
     * )
     *      
     * )
     */
     
     
     
     public function jsonPage(Request $request){
         
               $regle = array(
                "nom_magasin"=>"required",
                "adresse",
                "telephone",
                "numero"=>"unique:tickets",
                "caissiere",
                "nomArticle",
                            "autreModele",
                            "noticeDoc",
                            "notice",
                            "garantie",
                            "tuto",
                            "reparation",
                            "revente",
                            "quantite",
                            "pu",
                            "categories"=>"required",
                            "montant",
                            "net",
                            "tva",
                            "total"
                            
            );
            $validator = Validator::make($request->all(), $regle);
            
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            };


            $data = json_encode([
                "nom_magasin"=> $request->nom_magasin,
                "adresse"=> $request->adresse,
                "telephone"=> $request->telephone,
                "numero"=> $request->numero,
                "caissiere"=> $request->caissiere,
                "datas"=>[
                    "nomArticle"=> $request->nomArticle,
                    "autreModele"=> $request->autreModele,
                    "noticeDoc"=> $request->noticeDoc,
                    "notice"=> $request->notice,
                    "garantie"=> $request->garantie,
                    "tuto"=> $request->tuto,
                    "reparation"=> $request->reparation,
                    "revente"=> $request->revente,
                    "quantite"=> $request->quantite,
                    "pu"=> $request->pu,
                    "categories"=> $request->categories,
                    "montant"=> $request->montant,
                ],
                "net"=> $request->net,
                "tva"=> $request->tva,
                "total"=> $request->total,
                          
                          
            ]);
            	  
            $jsongFile = time() . '_file.json';
            $file = File::put(public_path('/'.$jsongFile), $data);
            
            $currenturl = "https://billlib.ubix-group.com/public/index.php";
            
            $link = new Lienjson();
                $link->lien = $currenturl.'/' .$jsongFile;
                $dat = $link->save();
                
            $lien =   $currenturl.'/' .$jsongFile;
                
            $qrcode = QrCode::size(200)->generate($lien);
                
        return view("qrcode", compact('qrcode', 'lien'));

     }
     
     public function test(){
         
           DB::table('lienjsons')->delete();
           
           return 1;
     }
    
    
      public function page(){
        return View('pageJson');
    }
    
    public function destroy(ticket $id)
    {
        return Ticket::destroy($id);
    }
    
    public function json(){
        return View('json');
    }
    
    public function json1(){
        return View('json1');
    }
}
