<?php

namespace App\Http\Controllers;

//use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use App\User;
use App\Renta;
use DB;


class DashController extends Controller
{


	public function data()
	{

  //current week sales
    $start = date('Y-m-d', strtotime('monday this week'));
    $finish = date('Y-m-d', strtotime('sunday this week'));  
    $weekSales='';       
    $array = array(); 

    $d1 = strtotime($start); 
    $d2 = strtotime($finish); 

    for ($currentDate = $d1; $currentDate <= $d2;  
      $currentDate += (86400)) { 

      $Store = date('Y-m-d', $currentDate); 
      $array[] = $Store;            
    } 



    $sql ="SELECT c.fecha, IFNULL(c.total,0) as total FROM (
    SELECT '$array[0]' AS fecha 
    UNION 
    SELECT '$array[1]' AS fecha 
    UNION 
    SELECT '$array[2]' AS fecha 
    UNION 
    SELECT '$array[3]' AS fecha 
    UNION 
    SELECT '$array[4]' AS fecha
    UNION
    SELECT '$array[5]' AS fecha
    UNION
    SELECT '$array[6]' AS fecha
  ) d
  LEFT JOIN(
  SELECT SUM(total)AS total, DATE(created_At)AS fecha FROM rentas WHERE created_at BETWEEN '$start' AND '$finish' AND estatus ='CERRADO'
  GROUP BY DATE(created_At)
)c  ON d.fecha = c.fecha";


$weekSales = DB::select(DB::raw($sql));





//sales by months
$salesByMonth = DB::select(DB::raw("
 SELECT m.MONTH AS MES, IFNULL(c.ventas,0)AS VENTAS, IFNULL(c.rentas,0) as TRANSACCIONES  FROM(
 SELECT 'january' AS MONTH  UNION  SELECT 'february' AS MONTH 
 UNION   SELECT 'march' AS MONTH  UNION 
 SELECT 'april' AS MONTH  UNION  SELECT 'may' AS MONTH 
 UNION  SELECT 'june' AS MONTH  UNION 
 SELECT 'july' AS MONTH  UNION  SELECT 'august' AS MONTH 
 UNION  SELECT 'september' AS MONTH  UNION 
 SELECT 'october' AS MONTH  UNION  SELECT 'november' AS MONTH 
 UNION  SELECT 'december' AS MONTH 
 )m
 left join(
 SELECT MONTHNAME(created_at) AS MONTH, COUNT(*) AS rentas, SUM(total)AS ventas 
 FROM rentas 
 WHERE YEAR(acceso)=2020
 GROUP BY MONTHNAME(created_at),MONTH(created_at) 
 ORDER BY MONTH(created_at)
 )  c ON m.MONTH =c.MONTH
 "));  




$chart2 = new LarapexChart();

$chart2->setTitle('Ventas Semana Actual')
->setLabels(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'])
->setType('donut')        
->setDataset([intval($weekSales[0]->total),intval($weekSales[1]->total),intval($weekSales[2]->total),intval($weekSales[3]->total),intval($weekSales[4]->total),intval($weekSales[5]->total),intval($weekSales[6]->total)]);


//en desarrollo
$chart3 = (new LarapexChart)->setTitle('Balance Anual(en desarrollo)')        
->setType('bar')
->setXAxis(['Ene', 'Feb', 'Mar'])
->setGrid(true)
->setDataset([
  [
    'name'  => 'Ventas',
    'data'  =>  [2500, 6100, 5000]
  ],
  [
    'name'  => 'Gastos',
    'data'  => [400, 700, 1500]
  ],
  [
    'name'  => 'Balance',
    'data'  => [2100, 4400, 3500]
  ]
])
->setStroke(1)
->setColors(['#2ECC71', '#E74C3C', '#3498DB']);




$chart = (new LarapexChart)->setType('area')
->setTitle('Ventas Anuales')
->setSubtitle('Por Mes')
->setXAxis([
  'Enero', 'Febrero', 'Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
])
->setDataset([
  [
    'name'  =>  'Ventas',
    'data'  =>  
    [
      $salesByMonth[0]->VENTAS,
      $salesByMonth[1]->VENTAS,
      $salesByMonth[2]->VENTAS,
      $salesByMonth[3]->VENTAS,
      $salesByMonth[4]->VENTAS,
      $salesByMonth[5]->VENTAS,
      $salesByMonth[6]->VENTAS,
      $salesByMonth[7]->VENTAS,
      $salesByMonth[8]->VENTAS,
      $salesByMonth[9]->VENTAS,
      $salesByMonth[10]->VENTAS,
      $salesByMonth[11]->VENTAS
    ]
  ]
]);






return view('dash', compact('chart','chart2','chart3','salesByMonth'));
}



public function getValue($data, $position)
{
  return isset($data[$position]) ? $data[$position]->TOTAL : 0;
}

}
