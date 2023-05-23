<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    
    
    
   
    /**
     * @OA\Put(
     *      path="/public/index.php/api/update/{id}",
     *      operationId="update",
     *      tags={"Article"},
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
     *            required={"nom_magasin, telephone, numero, adresse, caissiere, total_payer, net, tva"},
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
     *      @OA\Property(property="message", type="string", example="ticket bien modifié."),
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
  
    public function update(Request $request, Article $id)
    {
          $article = Article::findOrFail($id);
        
        $article->update($request->all());
        
        return $article;
    }

      /**
     * @OA\Delete(
     *      path="/public/index.php/api/destroy/{id}",
     *      operationId="destroy",
     *      tags={"Article"},
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
     *      @OA\Property(property="message", type="string", example="ticket bien supprimé."),
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
     
     
    public function destroy($id)
    {
         return Article::destroy($id);
    }
    
    
    public function getPrix($id){
    
        
    
       $byweek = Ticket::orderBy('created_at')->where("user_id", $id)->get()->groupBy(function($data) {
            return \Carbon\Carbon::parse($data->created_at)->format('W');
        });
      
     
        return $byweek;
        
    }
    
    
    
      /**
     * @OA\Get(
     *      path="/public/index.php/api/getPrix/{id}",
     *      operationId="getPrix",
     *      tags={"Ticket"},
     *      summary="get un ticket",
     *      description="get un ticket",
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
     *      @OA\Property(property="message", type="string", example="ticket bien modifié."),
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
    
    
       public function getPrixByMonth($id){
    
        
    
       $byweek = Ticket::orderBy('created_at')->where("user_id", $id)->get()->groupBy(function($data) {
            return \Carbon\Carbon::parse($data->created_at)->format('F');
        });
      
     
        return $byweek;
        
    }
    
     
    /**
     * @OA\Get(
     *      path="/public/index.php/api/getPrixByMonth/{id}",
     *      operationId="getPrixByMonth",
     *      tags={"Ticket"},
     *      summary="get un ticket",
     *      description="get un ticket",
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
     *      @OA\Property(property="message", type="string", example="ticket bien modifié."),
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
    
    
}
