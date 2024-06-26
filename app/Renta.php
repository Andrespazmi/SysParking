<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $fillable = ['acceso','salida','placa','modelo','marca','color','llaves','total','efectivo','cambio','user_id','vehiculo_id','tarifa_id','barcode','estatus','cajon_id','descripcion','hours','direccion'];

    protected $table ='rentas';



    public function tarifa()
    {
    	return $this->belongsTo(Tarifa::class);
    }



}
