<?php 

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DatabaseRepository implements CartRepository
{
    public function all(){
        return Cart::where('cookie_id',$this->getCookieId())
        ->orWhere('user_id',Auth::id())
        ->get();

    }
    public function add($item,$qty=1){
       $cart= Cart::updateOrCreate([//بتفحص هل هادا الايتم ولا لا فلو لا بتعمل كريت ولو اه بتعمل ابديت 
        //بتجيب الايتم اللي الكوكي ايدي بيساوي كدا والبرودكت ايدي بيساوي كدا فادا رجع رزلت حيعمل ابديت اللي هو عالااري اللي وارها هادي 
        //فاذا ما رجعت رزلت يعني مش موجود العنصر فبتعمل انسيرت للي بالارري التنيتن
        'cookie_id'=>$this->getCookieId(),
        'product_id'=>($item instanceof Product)?  $item->id : $item //check if this item is object(get id from it) or not(get it) 
       ],[
           'user_id'=>Auth::id(),
           'quantity'=>DB::raw('quantity + ' . $qty)
       ]);
       return $cart;

    }
    public function clear(){
            return Cart::where('cookie_id',$this->getCookieId())
            ->orWhere('user_id',Auth::id())
            ->delete();        
    }
    protected function getCookieId(){
       $id= Cookie::get('cart_cookie_id');
        if(!$id){//means that : this id not exist , so i will create this id and store it in cookie
            $id=Str::uuid();
            //store this id in cookie
            Cookie::queue('cart_cookie_id',$id,60*24*30);

        }
        return $id;
    }
    public function total(){
        $items=$this->all();
       $items->sum('quantity');
    //   return  $items->sum(function ($item){
    //         return $item->quantity * $item->product->price;
    //     });
    }
}