@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Contacto')

@section('content_header')
    <h1>Contacto</h1>

@stop

@section('content')

    <div>
        <ul>
            <li>El número de teléfono se tomará del dado en la pestaña WhatsApp</li>
        </ul>
    </div>

    @if(session('success') && session('success') == 'added')
        <div class="alert alert-dismiss alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Imagenes creadas</p>
            </button>
        </div>
    @endif
    @if(session('success') && session('success') == 'SocialAdded')
        <div class="alert alert-dismiss alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Redes añadidas</p>
            </button>
        </div>
    @endif
    @if(session('success') && session('success') == 'SocialEdited')
        <div class="alert alert-dismiss alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Redes editadas</p>
            </button>
        </div>
    @endif
    @if(session('success') && session('success') == 'edited')
        <div class="alert alert-dismiss alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Imagen editada</p>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <form id="add_image_form" action="{{route('admin.socialMedia')}}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input class="form-control" name="instagram" id="instagram" value="{{isset($instagram) ? $instagram : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input class="form-control" name="facebook" id="facebook" value="{{isset($facebook) ? $facebook : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="tiktok">TikTok</label>
                        <input class="form-control" name="tiktok" id="tiktok" value="{{isset($tiktok) ? $tiktok : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input class="form-control" name="address" id="address" value="{{isset($address) ? $address : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="maps">Google Maps</label>
                        <input class="form-control" name="maps" id="maps" value="{{isset($maps) ? $maps : ''}}">
                    </div>

                    <button class="btn btn-success" type="submit">
                        Guardar
                    </button>
                </form>
            </div>
            <div class="col-12 d-flex flex-wrap">
            @if (isset($contactImages))
                    <div class="col-12 mt-3 pl-0">
                        <div class="card">
                            <div class="card-body d-flex align-items-center" style="overflow-y: scroll">

                                @if(isset($contactImages->image_1))
                                    <div class="mr-5">
                                        <img src="{{asset($contactImages->image_1)}}" style="max-width: 300px">
                                        <br>
                                        <div class="d-flex align-items-center my-2">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalEditar2">
                                                Editar
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($contactImages->image_2))
                                    <div>
                                        <img src="{{asset($contactImages->image_2)}}" style="max-width: 300px">
                                        <br>
                                        <div class="d-flex align-items-center my-2">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalEditar2">
                                                Editar
                                            </button>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalEditar2" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><strong>Editar imagenes</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="add_image_form" action="{{route('admin.editarContacto')}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        @if(isset($contactImages->image_1))
                                            <img src="{{asset($contactImages->image_1)}}" style="max-width: 100%;">
                                        @endif
                                        <div class="form-group">
                                            <label for="title">Imagen 1</label>
                                            <input name="image_1" type="file">
                                        </div>
                                        @if(isset($contactImages->image_2))
                                            <img src="{{asset($contactImages->image_2)}}" style="max-width: 100%;">
                                        @endif
                                        <div class="form-group">
                                            <label for="title">Imagen 2</label>
                                            <input name="image_2" type="file">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                            <button id="guardar_cambios" type="submit" class="btn btn-primary">Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Button trigger modal -->
        @if(!isset($contactImages))
            <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#exampleModal">
                Agregar Contacto
            </button>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><strong>Subir Imagen</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add_image_form" action="{{route('admin.subirContacto')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Imagen 1</label>
                                <input name="image_1" type="file">
                            </div>
                            <div class="form-group">
                                <label for="title">Imagen 2</label>
                                <input name="image_2" type="file">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Cerrar
                                </button>
                                <button id="guardar_cambios" type="submit" class="btn btn-primary">Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

@stop

@section('js')
@stop
