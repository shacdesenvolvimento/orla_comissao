@extends('layouts.menu')
@section('conteudo')

<?php
$teste='teste';
?>
 <div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">Clientes</h5>
        </div>
        <div class="col-auto">
            <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCenter"
            
        >
            Adicionar Cliente
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
            <th>Cliente</th>
            <th>Razão Social</th>
            <th>CNPJ</th>
            <th>Contato</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $item)
                
            
          <tr>
            <td><strong>{{$item->id}}</strong>
           
          </td>
            <td>{{$item->nome}}</td>      
            <td>{{$item->RazaoSocial}}</td>  
            <td>{{$item->CNPJ}}</td>  
            <td>{{$item->Contato}}</td>                    
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <button type="button" class="dropdown-item btn-edit" onclick="funcao1(this)" data-id="{{$item->id}}" data-name="{{$item->nome}}" data-bs-toggle="modal" data-bs-target="#modalCenterEdit">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                  </button>
                  <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir o produto?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a
                  >

                  <form id="delete-form-{{ $item->id }}" action="{{ route('clientes.destroy', ['id'=> $item->id]) }}" method="POST" style="display: none;">
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
            <th>Cliente</th>
            <th>Razão Social</th>
            <th>CNPJ</th>
            <th>Contato</th>
            <th>Ações</th>
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
      
            Novo cliente
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
            <form method="POST" action="{{ route('inserir_cliente') }}">
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Nome</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="nome"
                        name="nome"
                        placeholder="John Doe"
                        aria-label="John Doe"
                        aria-describedby="basic-icon-default-fullname2"
                      />
                    </div>
                  </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-company">Razão Social</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text"
                    ><i class="bx bx-buildings"></i
                  ></span>
                  <input
                    type="text"
                    id="RazaoSocial"
                        name="RazaoSocial"
                    class="form-control"
                    placeholder="ACME Inc."
                    aria-label="ACME Inc."
                    aria-describedby="basic-icon-default-company2"
                  />
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-email">CNPJ</label>
                <div class="input-group input-group-merge">
                 {{--  <span class="input-group-text"><i class="bx bx-envelope"></i></span> --}}
                  <input
                    type="text"
                    id="CNPJ"
                        name="CNPJ"
                    class="form-control"
                    placeholder="john.doe"
                    aria-label="john.doe"
                    aria-describedby="basic-icon-default-email2"
                  />
                  <span id="basic-icon-default-email2" class="input-group-text">00.000.000/0000-00</span>
                </div>
                <div class="form-text">You can use letters, numbers & periods</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-phone">Telefone</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-phone2" class="input-group-text"
                    ><i class="bx bx-phone"></i
                  ></span>
                  <input
                    type="text"
                    id="Contato"
                        name="Contato"
                    class="form-control phone-mask"
                    placeholder="658 799 8941"
                    aria-label="658 799 8941"
                    aria-describedby="basic-icon-default-phone2"
                  />
                </div>
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
      
            Editar Cliente
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
            <form method="POST" action="{{ route('clientes.update') }}">
             
            <div class="col mb-3">
              <label for="nameWithTitle" class="form-label">Name</label>
              <input
                type="text"
                id="nome"
                name="nome"
                class="form-control"
                placeholder="Enter Name"
                
              />
              
              <input
                type="text"
                id="id"
                name="id"
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
  {{-- fim modal Edit --}}



  @endsection


    <script>
      function funcao1(clickedButton)
      {
        var id = $(clickedButton).data('id');
        var name = $(clickedButton).data('name');
        
        $('#modalCenterEdit #id').val(id);
        $('#modalCenterEdit #nome').val(name);
        
      }
  </script>