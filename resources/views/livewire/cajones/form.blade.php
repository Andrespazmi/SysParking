 <div class="widget-content-area ">
 	<div class="widget-one">
 		<form>
 			@include('common.messages')        

 			<div class="row">
 				<div class="form-group col-lg-4 col-md-4 col-sm-12">
 					<label >Nombre del Cajón</label>
 					<input wire:model.lazy="descripcion" type="text" class="form-control"  placeholder="nombre">
 				</div>
 				<div class="form-group col-lg-4 col-md-4 col-sm-12">
 					<label >Tipo</label>
 					<select wire:model="tipo" class="form-control text-center">
 						<option value="Elegir" disabled="">Elegir</option>
 						@foreach($tipos as $t)
 						<option value="{{ $t->id }}" >
 							{{ $t->descripcion}}
 						</option>                                       
 						@endforeach                              
 					</select>			               
 				</div>
 				
 				<div class="form-group col-lg-4 col-md-4 col-sm-12">
 					<label >Estatus</label>
 					<select wire:model="estatus" class="form-control text-center">
 						<option value="DISPONIBLE">DISPONIBLE</option>
 						<option value="OCUPADO">OCUPADO</option>
 					</select>
 				</div>
 				
 				
 			</div>
 			<div class="row ">
 				<div class="col-lg-5 mt-2  text-left">
 					<button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
 						<i class="mbri-left"></i> Regresar
 					</button>
 					<button type="button"
 					wire:click="StoreOrUpdate() " 
 					class="btn btn-primary ml-2">
 					<i class="mbri-success"></i> Guardar
 				</button>
 			</div>
 		</div>
 	</form>
 </div>
</div>