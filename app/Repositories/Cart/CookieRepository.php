<?php 

namespace App\Repositories\Cart;

use Illuminate\Support\Facades\Cookie;

class CookieRepository implements CartRepository
{
    protected $name='cart';
    public function all(){
       $items= Cookie::get($this->name);//get cookie that name is (cart)
       if($items){
           return unserialize($items);
       }
       return[];
    }
    public function add($item, $qty=1){
        $items=$this->all();
        $items[]=$item;

    return  Cookie::queue($this->name,serialize($items),60*24*30); //put this items (old items with item from req) in cookie ('cart')

    }
    public function clear(){
        return Cookie::queue($this->name, '',-60);
        
    }
}