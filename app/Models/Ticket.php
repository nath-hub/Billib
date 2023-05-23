<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    
     protected $fillable = [
       'nom_magasin',
       'telephone',
       'numero',
       'adresse',
       'caissiere',
       'net',
       'tva',
      'total_payer'
      
 
    ];
    
     
    public function article()
        {
          return $this->hasMany(Article::class);
        }
}
