<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
    @if($action == 1)
        
        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h4><b>Tarifas de Sistema</b></h4>
                    </div>
                </div>
            </div>
            @include('common.search')
            @include('common.alerts')
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">TIEMPO</th>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">COSTO</th>
                            <th class="text-center">TIPO</th>
                            <th class="text-center">JERARQUIA</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r)
                        <tr>
                            
                            <td class="text-center"><p class="mb-0">{{$r->id}}</p></td>
                            <td class="text-center">{{$r->tiempo}}</td>
                            <td class="text-center">{{$r->descripcion}}</td>
                            <td class="text-center">{{$r->costo}}</td>
                            <td class="text-center">{{$r->tipo}}</td>
                            <td class="text-center">{{$r->jerarquia}}</td>
                            <td class="text-center" class="text-center">
                                @include('common.actions')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$info->links()}}
            </div>
        </div>
        
    @elseif($action == 2)
    @include('livewire.tarifas.form')
    @endif
    </div>
    <script type="text/javascript">
    function Confirm(id)
    {
        let me = this
    swal({
    title: 'CONFIRMAR',
    text: '¿DESEAS ELIMINAR EL REGISTRO?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar',
    closeOnConfirm: false
    },
    function() {
    console.log('ID', id);
                window.livewire.emit('deleteRow', id)
                toastr.success('info', 'Registro eliminado con éxito')
                swal.close()
    })
        
    }
        
    document.addEventListener('DOMContentLoaded', function () {
    /*
        $('.add').on('click', function(e){
            e.preventDefault();
            window.livewire.emit('addMode')
            //@this.set('action', 5)
            console.log('ok')
        });
        /*
        window.livewire.on('addMode', () => {
            @this.set('action', 5)
        });
        */
    
    });
    </script>