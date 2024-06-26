<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Renta;
use Carbon\Carbon;

class VentasPorFecha extends Component
{
	public $fecha_ini, $fecha_fin;

	public function mount()
	{
		//$this->fecha_ini = Carbon::now();
		//$this->fecha_fin = Carbon::now();
	}
   
    public function render()
    {
    	
    	$fi = Carbon::parse(Carbon::now())->format('Y-m-d').' 00:00:00';
    	$ff = Carbon::parse(Carbon::now())->format('Y-m-d').' 23:59:59';

    	if($this->fecha_ini !== '')
    	{
    		$fi = Carbon::parse($this->fecha_ini)->format('Y-m-d').' 00:00:00';
    		$ff = Carbon::parse($this->fecha_fin)->format('Y-m-d').' 23:59:59';
    	}

    	
		$ventas = Renta::leftjoin('tarifas as t', 't.id', 'rentas.tarifa_id')
					->leftjoin('users as u', 'u.id', 'rentas.user_id')
					->select('rentas.*', 't.costo as tarifa','t.descripcion as vehiculo', 'u.nombre as usuario')
					->whereBetween('rentas.created_at',[$fi , $ff ])
					->paginate(10);




	$sumaTotal = $ventas->Sum('total');

        return view('livewire.reportes.ventas-por-fecha',[
        	'info' => $ventas,
        	'sumaTotal' => $sumaTotal
        ]);
    }


   
   
    



}
