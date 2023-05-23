<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Article extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
      
      "nomArticle",
      "notice",
      "noticeDoc",
      "garantie",
      "quantite",
      "pu",
      "categories",
      "tuto",
      "reparation",
      "autreModele",
      "revente",
      "prix"
 
    ];
    
    
    
    public function ticket()
        {
          return $this->belongsTo(Ticket::class);
        }
    
    
}
