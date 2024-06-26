<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Empresa;
use App\Cajon;
use App\Tipo;
use App\Tarifa;
use App\Renta;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.template', function($view)
        {
            //Global validation for setting up
            $empresa =  Empresa::count();
            $cajones =  Cajon::count();
            $tipos   =  Tipo::count();
            $tarifas =  Tarifa::count();
            $rentas  =  Renta::where('vehiculo_id', '>', 0)->where('estatus','ABIERTO')->select('acceso','salida')->get();

            $rentasVencidas  = 0;
            $rentasPorVencer = 0;
           
            foreach ($rentas as $r) {
                $start  =  Carbon::parse($r->acceso);
                $end    =  Carbon::parse($r->salida);                       

                if(Carbon::now()->greaterThan($end))  
                {
                    $rentasVencidas++;
                }
                else {                
                    $days = $start->diffInDays($end);                                    
                    if($days > 0 && $days <=3) $rentasPorVencer ++;
                }            

            }     

            
            $tiposSinTarifa = DB::table("tipos")->select('*')
            ->whereNOTIn('id',function($query){
             $query->select('tipo_id')->from('tarifas');
         })
            ->count();


            $view->with(['empresa'=> $empresa, 'cajones' => $cajones, 'tipos' => $tipos, 'tarifas'=> $tarifas, 'tiposSinTarifa' =>$tiposSinTarifa,
            'rentasVencidas' => $rentasVencidas, 'rentasPorVencer' => $rentasPorVencer ]);
        });
    }
}
