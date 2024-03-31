@extends('layouts.menu')
@section('conteudo')


 <div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">Cargos</h5>
        </div>
        <div class="col-auto">
            <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCenter"
        >
            Adicionar Cargo
            </button>
        </div>
</div>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Cargo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($cargos as $item)
                
            
          <tr>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->id}}</strong></td>
            <td>{{$item->nome}}</td>                        
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                  <form id="delete-form-{{ $item->id }}" action="{{ route('cargos.destroy', ['id'=> $item->id])}}" method="post" style="display:none">
                    @csrf
                    @method('DELETE')
                
                </form>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot class="table-border-bottom-0">
          <tr>
            <th>Id</th>
            <th>Cargo</th>
            <th>Ações </th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
   <!-- Modal -->
   <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Novo Cargo</h5>
        
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form method="POST" action="{{ route('inserir_cargo') }}">
            <div class="col mb-3">
              <label for="nameWithTitle" class="form-label">Name</label>
              <input
                type="text"
                id="nome"
                name="nome"
                class="form-control"
                placeholder="Enter Name"
              />
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          
            @csrf
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
    
  </div>

<!--FUNÇÃO EXCLUIR-->

<!--FUNÇÃO EXCLUIR-->
  @endsection