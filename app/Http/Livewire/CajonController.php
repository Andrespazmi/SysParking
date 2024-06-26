<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Cajon;
use App\Tipo;

class CajonController extends Component
{   
    use WithPagination;

	//poublic properties
	public  $tipo ='Elegir',$descripcion, $estatus='DISPONIBLE'; //campos de la tabla cajones
	public  $selected_id, $search;   						     //para búsquedas y fila seleccionada
    public  $action = 1;             						     //manejo de ventanas
    private $pagination = 5;         						     //paginación de tabla
    public  $tipos;


    //método que se ejecuta al inciar el componente
    public function render()
    {
      $this->tipos = Tipo::all();
       //retorna la vista:  livewire/cajones/component
      if(strlen($this->search) > 0)
      {
       $info = Cajon::leftjoin('tipos as t','t.id', 'cajones.tipo_id')
       ->select('cajones.*','t.descripcion as tipo')
       ->where('cajones.descripcion', 'like', '%' .  $this->search . '%')
       ->orWhere('cajones.estatus', 'like', '%' .  $this->search . '%')
       ->paginate($this->pagination);

       return view('livewire.cajones.component', [
        'info' => $info,
    ]);

   }
   else {

     $cajones = Cajon::leftjoin('tipos as t','t.id', 'cajones.tipo_id')
     ->select('cajones.*','t.descripcion as tipo')
     ->orderBy('cajones.id','desc')
     ->paginate($this->pagination);

     return view('livewire.cajones.component', [
        'info' => $cajones,
    ]);
 }
}

    //permite la búsqueda cuando se navega entre el paginado
public function updatingSearch()
{
    $this->gotoPage(1);
}

    //activa la vista edición o creación
public function doAction($action)
{
    $this->resetInput();
    $this->action = $action;

}

	//método para reiniciar variables
private function resetInput()
{
    $this->descripcion = '';
    $this->tipo = 'Elegir';
    $this->estatus = 'DISPONIBLE';       
    $this->selected_id = null;       
    $this->action = 1;
    $this->search = '';
}

    //buscamos el registro seleccionado y asignamos la info a las propiedades
public function edit($id)
{
    $record = Cajon::findOrFail($id);
    $this->selected_id = $id;
    $this->tipo = $record->tipo_id;
    $this->descripcion = $record->descripcion;
    $this->estatus = $record->estatus;        
    $this->action = 2;

}


    //método para registrar y/o actualizar registros
public function StoreOrUpdate()
{         	

   $this->validate([    		 
     'tipo'   => 'not_in:Elegir'
 ]);


   $this->validate([
    'descripcion' => 'required',
    'tipo' => 'required',
    'estatus' => 'required'
]);


   if($this->selected_id <= 0) { 
    $cajon =  Cajon::create([
        'descripcion' => $this->descripcion,            
        'tipo_id' => $this->tipo,         
        'estatus' => $this->estatus                    
    ]);

}
else 
{    	      
    $record = Cajon::find($this->selected_id);
    $record->update([
        'descripcion' => $this->descripcion,            
        'tipo_id' => $this->tipo,         
        'estatus' => $this->estatus    
    ]);

}


if($this->selected_id)              
   $this->emit('msgok', "Cajón Actualizado con éxito");
else
    $this->emit('msgok', "Cajón Registrado con éxito");             


$this->resetInput();


}


    //escuchar eventos y ejecutar acción solicitada
protected $listeners = [
    'deleteRow'     => 'destroy'
];  

public function destroy($id)
{
    if ($id) {
        // Elimina los registros relacionados en la tabla rentas
        \DB::table('rentas')->where('cajon_id', $id)->delete();

        // Luego elimina el registro en la tabla cajones
        $record = Cajon::findOrFail($id);
        $record->delete();

        $this->resetInput();
        $this->emit('msgok', "Cajón Eliminado con éxito");
    }
}


}


    


