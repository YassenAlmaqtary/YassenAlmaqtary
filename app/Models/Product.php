<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected  $fillable = [
        'id','vendor_id' ,'main_categorie_id','sub_categorie_id', 
        'translation_lang', 'translation_of', 'name','description', 'slug', 
        'price','quntity','activ','created_at', 'updated_at',
    ];


    protected $hidden = [
        'created_at', 'updated_at'
    ];


    public function scopeActive($qury)
    {

        return $qury->where('active', 1);
    }

   

    public function scopeSelection($qury)
    {

        return $qury->select('id','translation_lang', 'name', 'slug', 'active','price','quntity');
    }



    public function getActive()
    {

        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }
    


    public function products()
    {
      return $this->hasMany(self::class,'translation_of');
    }
   

    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id','id');
      }

      public function mainCategory()
    {
      return $this->belongsTo(MainCategorie::class,'main_categorie_id','id');
    }
    
      public function Subctegory(){
        return $this->belongsTo(SubCategorie::class,'sub_categorie_id','id');
      }


     public function photos(){
        
       return $this->hasMany(ProductPhoto::class,'product_id','id');
     }

}
