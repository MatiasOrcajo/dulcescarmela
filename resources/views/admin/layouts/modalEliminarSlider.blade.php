{{-- eliminar --}}

<div class="modal fade" id="modalEliminar{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Slider</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body pb-0">
                <form action="{{route('admin.eliminarSlider', $slider->id)}}" method="POST" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    
                    <h3>¿Segura que deseas eliminar el slider?</h3>

                    <div class="modal-footer p-0 mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>