@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Nosotras')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    

<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex flex-wrap">
            @forelse ($categories as $category)
            <div class="col-md-4 mt-3 pl-0 contenedor-slider-admin">
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset($category->image)}}" alt="" style="max-height: 800px; width: auto;">
                    </div>
                    <div class="card-body">
                        {{$category->name}}
                    </div>
                    <div class="card-footer">
                        Visible: {{$category->visible == App\Models\Constants::CATEGORY_IS_VISIBLE ? 'Si' : 'No'}}
                    </div>
                </div>
                <button type="button" id="" data="{{$category->id}}" class="delete_category btn btn-danger" data-toggle="modal" data-target="#modalEliminar">
                    Eliminar
                </button>
                <button type="button" data="{{$category->id}}" class="btn btn-primary edit_category" data-toggle="modal" data-target="#modalEditar{{$loop->iteration}}">
                    Editar
                </button>
                <a href="{{route('admin.categories.show', $category->slug)}}">
                    <button class="btn btn-success">
                        Ver
                    </button>
                </a>
            </div>
            @empty
                <p>No se han encontrado categorias</p>
            @endforelse
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" id="create_category">
        Crear Categoria
    </button>
</div>


@stop

@section('css')
  
@stop

@section('js')
{{-- <script src="{{asset('ckeditor/build/ckeditor.js')}}"></script> --}}
<script src="{{asset('js/app.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

// editar categoria

    $.each($('.edit_category'), function(){
        $(this).click(async function(e){
            const id = e.target.getAttribute('data');
            const route = '{{route('admin.categories.create')}}';

            $.ajax({
                url: '{{route('admin.categories.get')}}',
                type: 'GET',
                data:{
                    id: id
                },
                success: function(res){
                    categoryName = res.category.name;
                    categoryOrder = res.category.order;
                    visible = res.category.visible;

                    executeSwal();
                }
            })
            function executeSwal(){
                const { value: formValues } = Swal.fire({
                    title: 'Editar categoría',
                    html:
                        `<input id="name" name="name" class="swal2-input w-75" placeholder="Nombre" value="${categoryName}">` +
                        `<input id="order" type="number" name="order" class="swal2-input w-75" placeholder="Orden" value="${categoryOrder}">`+
                        '<input name="edit" class="swal2-input w-75" type="hidden" id="edit">'+
                        '<label for="visible" class="w-25">Visible:</label>'+
                        `<select name="visible" id="visible" class="w-50 mt-3">`+
                            `<option value="{{App\Models\Constants::CATEGORY_IS_VISIBLE}}" ${visible == 1 ?'selected' : ''}>Si</option>`+
                            `<option value="{{App\Models\Constants::CATEGORY_ISNT_VISIBLE}}" ${visible == 0 ? 'selected' : ''}>No</option>`+
                        `</select>`+
                        '<input id="image" name="image" type="file" class="mt-3 w-75">',
                    focusConfirm: false,
                    confirmButtonText: 'CREAR',
                    showCloseButton: true,
                    preConfirm: () => {
                        
                        const name  = $('#name')[0].value;
                        const order = $('#order')[0].value;
                        const image = $('#image')[0].files[0];
                        const edit  = $('#edit')[0];
                        const visible = $('#visible')[0].value;

                        const form = new FormData();
                        form.append('_token', '{{ csrf_token() }}')
                        form.append('name', name);
                        form.append('order', order);
                        form.append('image', image);
                        form.append('edit', edit);
                        form.append('id', id);
                        form.append('visible', visible);

                        $.ajax({
                            url : route,
                            type : 'POST',
                            datatype : 'json',
                            data: form,
                            processData: false,  // tell jQuery not to process the data
                            contentType: false,   // tell jQuery not to set contentType
                            success: function(res){
                                Swal.fire({
                                    icon: 'success',
                                    confirmButtonText:
                                        '<button id="delete_button" class="btn btn-success w-100 h-100">Guardar Cambios</button>',
                                    title: '<strong>Categoria editada</strong>',
                                })
                                .then(function(){
                                    location.reload();
                                })
                            } 
                        })
                        return null;
                    }
                })

                if (formValues) {
                    Swal.fire(JSON.stringify(formValues))
                }
            }
            
        })
    })



// eliminar categoria
    $.each($('.delete_category'), function(){
        $(this).click(function(e){
            const id = e.target.getAttribute('data');
            const route = '{{route('admin.categories.delete')}}';
            Swal.fire({
                title: '<strong>¿Segura de que deseas eliminar la categoria? Se eliminaran también los productos asociados a esta</strong>',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<button id="delete_button" class="btn w-100 h-100" style="color: white;">Si</button>',
                cancelButtonText:
                    '<button id="" class="btn w-100 h-100" style="color: white;">No</button>',
            })
            .then(function(){
                $.ajax({
                    url: route,
                    type: "DELETE",
                    datatype: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(res){
                        Swal.fire({
                            icon: 'success',
                            confirmButtonText:
                                '<button id="delete_button" class="btn btn-success w-100 h-100">OK</button>',
                            title: '<strong>Categoria eliminada</strong>',
                        })
                        .then(function(){
                            location.reload();
                        })
                    }
                })
            })

        })
    })

    // editar categoria



    // crear categoria
        
        $('#create_category').on('click', async function(e)
        {
            const route = '{{route('admin.categories.create')}}';
            const { value: formValues } = await Swal.fire({
                title: 'Crear categoría',
                html:
                    '<input id="name" name="name" class="swal2-input w-75" placeholder="Nombre">' +
                    '<input id="order" type="number" name="order" class="swal2-input w-75" placeholder="Orden">'+
                    '<label for="visible" class="w-25">Visible:</label>'+
                    '<select name="visible" id="visible" class="w-50 mt-3">'+
                        '<option value="{{App\Models\Constants::CATEGORY_IS_VISIBLE}}">Si</option>'+
                        '<option value="{{App\Models\Constants::CATEGORY_ISNT_VISIBLE}}">No</option>'+
                    '</select>'+
                    '<input id="image" name="image" type="file" class="mt-3 w-75">',
                focusConfirm: false,
                confirmButtonText: 'CREAR',
                showCloseButton: true,
                preConfirm: () => {
                    
                    const name = $('#name')[0].value;
                    const order = $('#order')[0].value;
                    const image = $('#image')[0].files[0];
                    const visible = $('#visible')[0].value;

                    const form = new FormData();
                    form.append('_token', '{{ csrf_token() }}')
                    form.append('name', name);
                    form.append('order', order);
                    form.append('image', image);
                    form.append('visible', visible);

                    $.ajax({
                        url : route,
                        type : 'POST',
                        datatype : 'json',
                        data: form,
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,   // tell jQuery not to set contentType
                        success: function(res){
                            Swal.fire({
                                icon: 'success',
                                confirmButtonText:
                                    '<button id="delete_button" class="btn btn-success w-100 h-100">OK</button>',
                                title: '<strong>Categoria creada</strong>',
                            })
                            .then(function(){
                                location.reload();
                            })
                        } 
                    })
                    return null;
                }
            })

                if (formValues) {
                    Swal.fire(JSON.stringify(formValues))
                }
        })

    

   
</script>
@stop