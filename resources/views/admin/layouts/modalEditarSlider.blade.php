
            <div class="modal fade" id="modalEditar{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.editarSlider', $slider->id)}}" method="POST" enctype="multipart/form-data">
                            {{-- @method('PUT') --}}
                            @csrf
                            <div class="form-group">
                                <label for="orden">Orden</label>
                                <input type="text" id="orden" class="form-control" name="orden" value="{{$slider->order}}">
                            </div>
                            <div class="form-group">
                                <label for="texto">Texto</label>
                                <input type="text" id="texto" class="form-control" name="texto" value="{{$slider->text}}">
                            </div>
                            <div class="form-group mt-5">
                                <img src="{{asset($slider->image)}}" alt="" style="height: 150px; width: auto;" class="mb-4">
                                <input type="file" name="imagen">
                            </div>
    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>