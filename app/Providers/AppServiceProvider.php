<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Periodos;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
      $periodo_carga=Periodos::select('periodos.*')->where('en_carga','=',true)->get();     
      $periodo_consulta=Periodos::select('periodos.*')->where('en_carga','=',false)->get();      
      $menu_periodo = [$periodo_carga, $periodo_consulta];             
      view()->share('periodo_en_carga', $menu_periodo);    
    }

    // public function register()
    // {
    //     //
    // }
}
