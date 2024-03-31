@extends('layouts.menu')
@section('conteudo')

<?php
$teste='teste';
?>
 <div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">produtos</h5>
          </div>
          <div class="col-auto">
              <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#modalCenter">
                Adicionar produto
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
            <th>Nome</th>
            <th>Regra</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $item)
                
            
          <tr>
            <td><i class=""></i> <strong>{{$item->id}}</strong>
          </td>     
            <td>{{$item->nome}}</td>  
            <td>{{$item->regra->nome}}</td>                
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <button type="button" class="dropdown-item btn-edit" onclick="funcao1(this)" 
                  data-id="{{$item->id}}" 
                  data-nome="{{$item->nome}}"
                  data-id_regra="{{$item->id_regra}}"



                  data-bs-toggle="modal" 
                  data-bs-target="#modalCenterEdit">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                  </button>
                  <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir o produto?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a
                  >

                  <form id="delete-form-{{ $item->id }}" action="{{ route('produtos.destroy', ['id'=> $item->id]) }}" method="POST" style="display: none;">
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
            <th>Nome</th>
            <th>Regra</th>
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
      
            Novo produto
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
            <form method="POST" action="{{ route('inserir.produto') }}">
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
                <label for="defaultSelect" class="form-label">Regra</label>
                <select id="regra"  name="regra" class="form-select">
                  <option>Selecione regra</option>
                  @foreach ($regras as $regra)
                  <option value="{{$regra->id}}">{{$regra->nome}}</option>
                  @endforeach
                  
                </select>
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
            Novo produto
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
            <form method="POST" action="{{ route('produtos.update') }}">
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
                      <input
                      type="hidden"
                      id="id"
                      name="id"
                      
                    />
                    </div>
                  </div>
                         
              <div class="mb-3">
                <label for="defaultSelect" class="form-label">Regra</label>
                <select id="regra"  name="regra" class="form-select">
                  <option >Selecione regra</option>
                  @foreach ($regras as $regra)
                  <option value="{{$regra->id}}">{{$regra->nome}}</option>
                  @endforeach
                  
                </select>
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
        var id_regra = $(clickedButton).data('id_regra');
        
        $('#modalCenterEdit #id').val(id);
        $('#modalCenterEdit #nome').val(nome);
        $('#modalCenterEdit #regra').val(id_regra);





        
      }
  </script>