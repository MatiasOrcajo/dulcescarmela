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
            <table class="table">
                <thead>
                  <tr>
                    <th class="col-md-1"></th>
                    <th class="col-md-3">Titulo</th>
                    <th class="col-md-4">Descripción</th>
                    <th class="col-md-1">¿Tiene Especificaciones?</th>
                    <th class="col-md-1">Precio</th>
                    <th class="col-md-1">¿Tiene Descuento?</th>
                    <th class="col-md-1">Precio Descuento</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ( $category->products as $product)
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$product->title}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->specs ? 'Sí' : 'No'}}</td>
                      <td>${{$product->price}}</td>
                      <td>{{$product->has_discount ? 'Sí':'No'}}</td>
                      <td>${{$product->discount_price ? $product->discount_price : ''}}</td>
                      <td>
                        <a href="{{route('admin.product.show', $product->slug)}}">
                          <button class="btn btn-primary">
                            Ver
                          </button>
                        </a>
                      </td>
                      <td>
                        <a href="">
                          <button class="btn btn-danger">
                            Eliminar
                          </button>
                        </a>
                      </td>
                    </tr>
                  @empty
                    No hay productos para esta categoría
                  @endforelse
                </tbody>
            </table>
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
<script>
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