<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return [
            'nomArticle' => $this->nomArticle,
            'quantite' => $this->quantite,
            'pu' => $this->pu,
            'montant' => $this->montant,
            'notice' => $this->notice,
            'noticeDoc' => $this->noticeDoc,
            'categories'=> $this->categories,
            'tuto'=> $this->tuto,
            'reparation'=> $this->reparation,
            'autreModele'=> $this->autreModele, 
            'revente'=> $this->revente,
                
            'total' => $this->total,
            'nom_magasin' => $this->ticket->nom_magasin,
            'telephone' => $this->ticket->telephone,
            'caissiere' => $this->ticket->caissiere,
            'adresse' => $this->ticket->adresse,
            'net' => $this->ticket->net,
            'tva' => $this->ticket->type,
            'numero' => $this->ticket->numero,
            'total_payer' => $this->ticket->total_payer,
      ];
    }
}
