<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy'
        // User::class=>UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    //     Gate::before(function($user,$ability){
    //         if($user->type=='user'){
    //             return true;
    //         }
    //     });
    //      foreach(config('abilites') as $key => $value){
    //          Gate::define($key,function($user) use ($key){
    //            $user->hasAbility($key);
            
    //          });
            
    //          }
    }
}
