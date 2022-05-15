@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Nosotras')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    
@if(session('success'))
  <div class="alert alert-dismiss alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert">
      <h4>Success!</h4>
      <p>Nuevo producto creado</p>
    </button>
  </div>
@endif
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Crear Producto
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.product.create', $category->slug)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Titulo">
              </div>
              <div class="form-group">
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Descripción" cols="30" rows="10"></textarea>
              </div>

              {{-- 14/5/2022 Queda ver el tema "especificaciones", creo es mejor verlo una vez la web esté en producción --}}
              <div class="form-group">
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Precio">
              </div>
              <div class="form-group">
                <label for="">Precio de descuento (solo en caso de tener): </label>
                <input type="number" class="form-control @error('discount_price') is-invalid @enderror" name="discount_price" placeholder="Precio">
              </div>
              <div class="form-group">
                <label for="files">Seleccionar fotode portada (si no se sube ninguna, se puede seleccionar desde la vista del producto una imagen como portada):</label>
                <br>
                <input accept="image/*" type="file" name="cover_photo" id="" class="">
              </div>
              <div class="form-group">
                <label for="files">Seleccionar fotos del producto:</label>
                <br>
                <input accept="image/*" type="file" name="images[]" id="" class="" multiple class="@error('images[]') is-invalid @enderror">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>


@stop

@section('css')
  
@stop

@section('js')