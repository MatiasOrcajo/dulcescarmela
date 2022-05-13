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
            <form action="" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Titulo">
              </div>
              <div class="form-group">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="description" placeholder="Descripción">
              </div>
              <div class="form-group">
                <label for="files">Seleccionar fotos:</label>
                <br>
                <input accept="image/*" type="file" name="images[]" id="" class="" multiple>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</div>


@stop

@section('css')
  
@stop

@section('js')