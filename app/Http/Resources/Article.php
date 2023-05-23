<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
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
        'nom' => $this->nom,
        'quantite' => $this->quantite,
        'pu' => $this->pu,
        'montant' => $this->montant,
        'lien' => $this->lien,
        'document' => $this->document,
        'total' => $this->total,
        'id' => $this->ticket->id,
        'nom_magasin' => $this->ticket_id,
        'telephone' => $this->total,
        'numero' => $this->total,
        'enseigne' => $this->total,
        'type' => $this->total,
        'total_payer' => $this->total,
      ];
    }
}
