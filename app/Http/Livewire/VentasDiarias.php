<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Renta;
use Carbon\Carbon;

class VentasDiarias extends Component
{
	public $fecha_ini, $fecha_fin;
   
    public function render()
    {
    	/*
    	$datetime1 = new \DateTime('2020-06-22 15:14:28');
		$datetime2 = new \DateTime('2020-06-22 16:14:49');
		$hours = round(($datetime2->getTimestamp() - $datetime1->getTimestamp()) / 3600, 2);
		dd($hours); 
		*/


    	//$ventas = Renta::whereDate('created_at', Carbon::today())->paginate(10);
	$ventas = Renta::leftjoin('tarifas as t', 't.id', 'rentas.tarifa_id')
					->leftjoin('users as u', 'u.id', 'rentas.user_id')
					->select('rentas.*', 't.costo as tarifa','t.descripcion as vehiculo', 'u.nombre as usuario')
					->whereDate('rentas.created_at', Carbon::today())
                    ->orderBy('id','desc')
					->paginate(10);

	$sumaTotal = $ventas->Sum('total');

        return view('livewire.reportes.ventas-diarias',[
        	'info' => $ventas,
        	'sumaTotal' => $sumaTotal
        ]);
    }


    public function VentasDelDia()
    {
    	


    	
    	
    }
    public function VentasPorFecha()
    {
    	$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    	$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
    	   	

    	$ventas = Renta::whereBetween('created_at',[$fi , $ff ])->get();
    	
    }




}
