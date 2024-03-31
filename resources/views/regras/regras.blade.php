@extends('layouts.menu')
@section('conteudo')

<?php
$teste='teste';
?>
 <div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">Regras</h5>
        </div>
        <div class="col-auto">
            <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCenter"
            
        >
            Adicionar Regra
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
            <th>Regra</th>
            <th>Valor minimo</th>
            <th>Duração/ Meses</th>
            <th>Ações </th>
          </tr>
        </thead>
        <tbody>
            @foreach ($regras as $item)
                
            
          <tr>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->id}}</strong>
           
          </td>
            <td>{{$item->nome}}</td> 
            <td>{{$item->valor_minimo}}</td>    
            <td>{{$item->quant_meses}}</td>                           
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <button type="button" class="dropdown-item btn-edit" onclick="funcao1(this)" 
                  data-id="{{$item->id}}"
                  data-nome="{{$item->nome}}"
                  data-valor_minimo="{{$item->valor_minimo}}"
                  data-quant_meses="{{$item->quant_meses}}"
                  
                  data-bs-toggle="modal" data-bs-target="#modalCenterEdit">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                  </button>
                  <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir o produto?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a
                  >

                  <form id="delete-form-{{ $item->id }}" action="{{ route('regras.destroy', ['id'=> $item->id]) }}" method="POST" style="display: none;">
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
            <th>Regra</th>
            <th>Valor minimo</th>
            <th>Duração/ Meses</th>
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
          <h5 class="modal-title" id="modalCenterTitle">
      
            Novo Regra
          </h5>
        
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form method="POST" action="{{ route('inserir.regra') }}">
            <div class="col mb-3">
              <label for="nameWithTitle" class="form-label">Nome</label>
              <input
                type="text"
                id="nome"
                name="nome"
                class="form-control"
                placeholder="Enter Name"
                
              />              
            </div>

            
          </div>
          <div class="row gy-3">
            <div class="col-md">
                <label for="nameWithTitle" class="form-label">
                    Valor minimo
                </label>
              <input type="number" id="valor_minimo" name="valor_minimo" step="0.01" min="0" placeholder="0.00" required>
            </div>
            <div class="col-md">
                <label for="nameWithTitle" class="form-label">
                    Duração /Meses
                </label>
              <input type="number" id="quant_meses" name="quant_meses" step="0.01" min="0" class="form-control" max="12" placeholder="0.00" required>
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
  {{-- fim modal --}}

  <!-- Modal Edit -->
  <div class="modal fade" id="modalCenterEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">
      
            Editar Regra
          </h5>
        
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form method="POST" action="{{ route('regras.update') }}">
             
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Nome</label>
                    <input
                      type="text"
                      id="nome"
                      name="nome"
                      class="form-control"
                      placeholder="Enter Name"
                      
                    />              
                    <input
                      type="hidden"
                      id="id"
                      name="id"/>              
                  </div>                  
                </div>
                <div class="row gy-3">
                  <div class="col-md">
                      <label for="nameWithTitle" class="form-label">
                          Valor minimo
                      </label>
                    <input type="number" id="valor_minimo" name="valor_minimo" step="0.01" min="0" placeholder="0.00" required class="form-control">
                  </div>
                  <div class="col-md">
                      <label for="nameWithTitle" class="form-label">
                          Duração /Meses
                      </label>
                    <input type="number" id="quant_meses" name="quant_meses" step="0.01" min="0" class="form-control" max="12" placeholder="0.00" required>
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
  {{-- fim modal Edit --}}



  @endsection


    <script>
      function funcao1(clickedButton)
      {
        var id = $(clickedButton).data('id');
        var nome = $(clickedButton).data('nome');
        var valor_minimo = $(clickedButton).data('valor_minimo');
        var quant_meses = $(clickedButton).data('quant_meses');
        
        $('#modalCenterEdit #id').val(id);
        $('#modalCenterEdit #nome').val(nome);
        $('#modalCenterEdit #valor_minimo').val(valor_minimo);
        $('#modalCenterEdit #quant_meses').val(quant_meses);
        
        
      }
  </script>