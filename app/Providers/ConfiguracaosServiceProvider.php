<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Schema;

class ConfiguracaosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Contracts\Cache\Factory $cache
     * @param \App\Setting                        $settings
     * 
     * @return void
     */
    
    public function boot()
    {

        if (Schema::hasTable('configuracaos')){
            $conf = DB::table('configuracaos')
                        ->select('type', 'name', 'value')
                        ->get();

            foreach($conf as $key=>$val){
              $type  = $val->type;
              $name  = $val->name;
              $value = $val->value;

              config([$type.'.'.$name => $value]);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
