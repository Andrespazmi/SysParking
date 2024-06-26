<div class="widget-content-area">
	<div class="widget-one">
		<div class="row">
			 @include('common.alerts')
			 @include('common.messages')
			<div class="col-12">
				<h4 class="text-center">Datos de la Empresa</h4>
			</div>
			<div class="form-group col-sm-12">
				<label >Nombre</label>
				<input wire:model.lazy="nombre" type="text" class="form-control text-left" >				 
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label >Teléfono</label>
				<input wire:model.lazy="telefono" maxlength="10" type="text" class="form-control text-center"  >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label >Email</label>
				<input wire:model.lazy="email" maxlength="55" type="text" class="form-control text-center"  >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label >Logo</label>
				<input type="file" class="form-control">
			</div>
			<div class="form-group col-sm-12">
				<label >Dirección</label>
				<input wire:model.lazy="direccion" type="text" class="form-control text-left"  >
			</div>
			<div class="col-12">
				<button type="button"
				wire:click="Guardar()"
				class="btn btn-primary ml-2">
				<i class="mbri-success"></i> Guardar
				</button>
			</div>
		</div>
	</div>
</div>