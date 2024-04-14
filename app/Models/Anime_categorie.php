<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anime_categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'anime_id',
        'categorie_id'
   ];
   protected $table = 'anime_categorie';

   public function anime()
   {
       return $this->belongsTo(Anime::class);
   }

 
   public function categorie()
   {
       return $this->belongsTo(Categorie::class);
   }

}
