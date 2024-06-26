<div>
   <div id="content" class="main-content">
            <div class="layout-px-spacing">


                <!-- CONTENT AREA -->
                

                <div class="row layout-top-spacing">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        <div class="widget-content-area br-4">
                            <div class="widget-one">

                                <h4 class="text-center">Reporte de Ventas Por Fecha</h4>
                                    
                                <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">Fecha inicial
                                         <div class="form-group mb-0">           
                                        <input wire:model.lazy="fecha_ini" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                    </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2 text-left">
                                     <div class="form-group mb-0">Fecha final
                                        <input wire:model.lazy="fecha_fin" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Haz click">
                                    </div>
                                     </div>
                                    <div class="col-sm-12 col-md-1 col-lg-1 text-left">
                                        <button type="submit" class="btn btn-info mt-4 mobile-only">Ver</button>
                                    </div>
                                    <div class="col-sm-12 col-md-1 col-lg-1 text-left ">
                                        <button class="btn btn-success mt-4 mobile-only">Exportar</button>
                                    </div>
                                     
                                    <div class="col-sm-12 col-md-3 col-lg-3 offset-lg-3">
                                        <b>Fecha de Consulta</b>: {{\Carbon\Carbon::now()->format('d-m-Y')}}
                                        <br>
                                        <b>Cantidad Registros</b>: {{ $info->count() }}
                                        <br>
                                        <b>Total Ingresos</b>: ${{ number_format($sumaTotal,2) }}
                                    </div>
                                    
                                </div>
                                <div class="row">
                                     <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                            <thead>
                                                <tr>                                                   
                                                    <th class="text-center">FOLIO</th>
                                                    <th class="text-center">VEHÍCULO</th>
                                                    <th class="text-center">ACCESO</th>
                                                    <th class="text-center">SALIDA</th>
                                                    <th class="text-center">TIEMPO</th>
                                                    <th class="text-center">TARIFA</th>
                                                    <th class="text-center">IMPORTE</th>
                                                    <th class="text-center">CÓDIGO</th>
                                                    <th class="text-center">USUARIO</th>
                                                    <th class="text-center">RENTA</th>
                                                    <th class="text-center">FECHA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($info as $r)
                                                <tr>
                                                   
                                                    <td class="text-center"><p class="mb-0">{{$r->id}}</p></td>
                                                    <td class="text-center">{{$r->vehiculo}}</td>
                                                    <td class="text-center">{{$r->acceso}}</td>
                                                    <td class="text-center">{{$r->salida}}</td>
                                                    <td class="text-center">{{$r->hours}} Hrs.</td>
                                                    <td class="text-center">${{number_format($r->tarifa,2)}}</td>
                                                    <td class="text-center">${{$r->total}}</td>
                                                    <td class="text-center">{{$r->barcode}}</td>
                                                    <td class="text-center">{{$r->usuario}}</td>
                                                    <td class="text-center" class="text-center">
                                                        @if($r->vehiculo_id == null)
                                                        POR HORA
                                                        @else
                                                        POR DIAS
                                                        @endif
                                                    </td>
                                                     <td class="text-center">{{$r->created_at}}</td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                             <tfoot>
                                                <tr>
                                                    <th class="text-right" colspan="10">SUMA IMPORTES:</th>
                                                    <th class="text-center" colspan="1">${{ number_format($sumaTotal,2) }}</th>                                                    
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
