<div>
   <div id="content" class="main-content">
            <div class="layout-px-spacing">


                <!-- CONTENT AREA -->
                

                <div class="row layout-top-spacing">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area br-4">
                            <div class="widget-one">

                                <h3 class="text-center">Rentas Próximas a Vencer</h3>
                                	
                                <div class="row">
                                	<div class="col-sm-12 col-md-4 col-lg-4 text-left">
                                		<b>Fecha de Consulta</b>: {{\Carbon\Carbon::now()->format('d-m-Y')}}
                                        <br>
                                        <b>Cantidad Registros</b>: {{ $info->count() }}
                                        <br>
                                      
                                	</div>
                                	<div class="col-sm-12 col-md-8 col-lg-8 text-right"><button class="btn btn-sm btn-dark mt-4">Exportar</button>
                                	</div>
                                </div>
                                <div class="row">
                                     <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                            <thead>
                                                <tr>                                                                                                  
                                                    <th class="text-center">CÓDIGO</th>
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">TELEFONO</th>
                                                    <th class="text-center">ACCESO</th>
                                                    <th class="text-center">T.RESTANTE</th>
                                                    <th class="text-center">SALIDA</th>
                                                    <th class="text-center">VEHÍCULO</th>
                                                    <th class="text-center">ESTATUS</th>
                                                   <th class="text-center">RENOVAR</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($info as $r)
                                                <tr>
                                                    <td class="text-center">{{$r->barcode}}</td>
                                                    <td class="text-center">{{$r->cliente}}</td>
                                                    <td class="text-center">{{$r->telefono}}</td>
                                                    <td class="text-center">{{\Carbon\Carbon::parse($r->acceso)->format('d-m-Y h:i:s')}}</td>
                                                    <td class="text-left">
                                                    	<h7 class="text-info">Años:{{$r->restanteyears}}</h7><br>
                                                    	<h7 class="text-info">Meses:{{$r->restantemeses}}</h7><br>
                                                    	<h7 class="text-danger">Días:{{$r->restantedias}}</h7><br>
                                                    	<h7 class="text-default">Horas:{{$r->restantehoras}}</h7><br>
                                                    	
                                                    </td>                                                   
                                                    <td class="text-center">{{\Carbon\Carbon::parse($r->salida)->format('d-m-Y h:i:s')}}</td>
                                                    <td class="text-left">
                                                    	<h7 class="text-info">Placa:{{$r->placa}}</h7><br>
                                                    	<h7 class="text-success">Modelo:{{$r->modelo}}</h7><br>
                                                    	<h7 class="text-danger">Marca:{{$r->marca}}</h7>
                                                    </td>   
                                                    <td class="text-center">
                                                    	@if($r->estado == 'VENCIDO')
                                                    	<h7 class="text-danger"><b>{{$r->estado}}</b></h7>
                                                    	@else

                                                    	@if($r->restantedias > 0)
                                                    	@if($r->restantedias >0 && $r->restantedias <=3)
                                                    	<h7 class="text-warning"><b>{{$r->estado}}</b></h7>
                                                    	@else
                                                    	<h7 class="text-success"><b>{{$r->estado}}</b></h7>
                                                    	@endif                                                    	
                                                    	@else
                                                    	<h7 class="text-danger"><b>{{$r->estado}}</b></h7>
                                                    	@endif

                                                    	@endif
                                                    </td>    
                                                     <td class="text-center">
                                                     	@if($r->estado != 'ACTIVO')
                                                     	<a href="javascript:void(0);"  
                                                        wire:click.prevent="$emit('checkOutTicketPension', {{$r->id}})"                                                       
                                                      data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></a>
                                                        @endif
                                                    </td>                                            
                     
                                                 
                                                </tr>
                                               @endforeach
                                            </tbody>
                                             <tfoot>
                                                <tr>
                                                	<th colspan="7"></th>
                                                    <th class="text-left" colspan="2">
                                                    	<h6 class="text-danger">Rentas Vencidas:{{$totalVencidos}}</h6>
                                                    	 <h6 class="text-warning">Próximas a Vencer: {{$totalProximas}}</h6>
                                                    </th>                                                                                                 
                                                </tr>
                                            </tfoot>
                                        </table>
                                           {{$info->links()}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>



                <!-- CONTENT AREA -->

            </div>
           
        </div>
        <!--  END CONTENT AREA  -->

</div>
