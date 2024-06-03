@extends('layouts.menu')
@section('conteudo')

<?php
$teste='teste';
?>
 <div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">contratos</h5>
        </div>
        <div class="col-auto">
            <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCenter"
            
        >
            Adicionar contrato
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
            <th>Codigo</th>
            <th>Produto</th>
            <th>Regra</th>
            <th>Unidade</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Comissão Cliente</th>
            <th>Ações</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($contratos as $item)
                
            
          <tr>
            <td><i class=""></i> <strong>{{$item->id}}</strong>
          </td>     
            <td>{{$item->produto->nome}}</td>  
            <td>{{$item->regra->nome}}</td> 
            <td>{{$item->unidade->nome}}</td>  
            <td>{{$item->cliente->nome}}</td>    
            <td>{{$item->vendedor->nome}}</td>
            <td>{{$item->permissao_comissao}}</td>
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
                  data-id_produto="{{$item->id_produto}}"

                  data-id_unidade="{{$item->id_unidade}}"
                  data-id_vendedor="{{$item->id_vendedor}}"
                  data-id_cliente="{{$item->id_cliente}}"
                  data-valor_contrato="{{$item->valor_contrato}}"
                  data-inicio_contrato="{{$item->inicio_contrato}}"
                  data-primeiro_pagamento="{{$item->primeiro_pagamento}}"
                  data-quant_meses="{{$item->quant_meses}}"
                  data-forma_pagamento="{{$item->forma_pagamento}}"
                  data-parcelas="{{$item->parcelas}}"



                  data-bs-toggle="modal" 
                  data-bs-target="#modalCenterEdit">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                  </button>
                  <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir o contrato?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a
                  >

                  <form id="delete-form-{{ $item->id }}" action="{{ route('contratos.destroy', ['id'=> $item->id]) }}" method="POST" style="display: none;">
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
            <th>Codigo</th>
            <th>Produto</th>
            <th>Regra</th>
            <th>Unidade</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Comissão Cliente</th>
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
      
            Novo Contrato
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
            <form method="POST" action="{{ route('inserir.contrato') }}">
              <div class="col-mb-3">
                <label for="defaultSelect" class="form-label">Produto</label>
                <select id="id_produto"  name="id_produto" class="form-select">
                  <option>Selecione produto</option>
                  @foreach ($produtos as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                  @endforeach                
                </select>
              </div>       
              </p>
              <div class="col-mb-3">
                
                <label for="defaultSelect" class="form-label">Unidade</label>
                <select id="id_unidade"  name="id_unidade" class="form-select">
                  <option>Selecione unidade</option>
                  @foreach ($unidades as $unidade)
                    <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                  @endforeach                
                </select>
              </div>      
              </div>
              <div class="row gy-3">
                <div class="col-md">
                  <label for="defaultSelect" class="form-label">Cliente</label>
                  <select id="id_cliente"  name="id_cliente" class="form-select">
                    <option>Selecione Cliente</option>
                    @foreach ($clientes as $cliente)
                      <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                    @endforeach                
                  </select>
                </div>
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Vendedor</label>
                <select id="id_vendedor"  name="id_vendedor" class="form-select">
                  <option>Selecione Vendedor</option>
                  @foreach ($vendedors as $vendedor)
                    <option value="{{$vendedor->id}}">{{$vendedor->nome}}</option>
                  @endforeach                
                </select>
              </div>
            </div>
        
            <hr style="color: brown">
            </p>
            <h5 class="modal-title" id="modalCenterTitle">
        
              Valores e Prazos
            </h5>
          </p>
                {{-- forma de pagamento --}}
                <div class="row gy-3">
                  <div class="col-md">
                    <label for="defaultSelect" class="form-label">Forma de pagamento</label>
                    <select id="forma_pagamento"  name="forma_pagamento" class="form-select">
                      <option>Selecione Forma</option>
                      <option value="vista">A vista</option>
                      <option value="parcelado">Parcelado</option>
                    </select>
                  </div>
                <div class="col-md">
                  <label for="defaultSelect" class="form-label">Parcelas</label>
                    <input type="number" id="parcelas" name="parcelas" class="form-select">
                </div>
              </div>
    
                {{-- forma de pagamento --}}
             </p>
            <div class="row gy-3">
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Inicio Contrato</label>
                <input
                type="date"
                class="form-control"
                id="inicio_contrato"
                name="inicio_contrato"
                placeholder="John Doe"
                aria-label="John Doe"
                aria-describedby="basic-icon-default-fullname2"
              />
                
              </div>
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Valor Contrato</label>
                <span>R$</span>
                <input type="number" id="valor_contrato" name="valor_contrato" step="0.01" min="0" placeholder="0.00" class="form-control" required>
              </div>
            </div>
            </p>
            <div class="row gy-3">
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Primeiro Pagamento</label>
                <input type="date" id="primeiro_pagamento" name="primeiro_pagamento" step="0.01" min="0" placeholder="00/00/0000" class="form-control" required>
              </div>
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Quant. meses</label>              
                <input type="number" id="quant_meses" name="quant_meses" step="0.01" min="0" placeholder="00" class="form-control" required>
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
            Edita contrato
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
            <form method="POST" action="{{ route('contrato.update') }}">
              <div class="col-mb-3">
                <label for="defaultSelect" class="form-label">Produto</label>
                <select id="id_produto"  name="id_produto" class="form-select">
                  <option>Selecione produto</option>
                  @foreach ($produtos as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                  @endforeach                
                </select>
              </div>       
              </p>
              <div class="col-mb-3">
                
                <label for="defaultSelect" class="form-label">Unidade</label>
                <select id="id_unidade"  name="id_unidade" class="form-select">
                  <option>Selecione unidade</option>
                  @foreach ($unidades as $unidade)
                    <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                  @endforeach                
                </select>
              </div>      
              </div>
              <div class="row gy-3">
                <div class="col-md">
                  <label for="defaultSelect" class="form-label">Cliente</label>
                  <select id="id_cliente"  name="id_cliente" class="form-select">
                    <option>Selecione Cliente</option>
                    @foreach ($clientes as $cliente)
                      <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                    @endforeach                
                  </select>
                </div>
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Vendedor</label>
                <select id="id_vendedor"  name="id_vendedor" class="form-select">
                  <option>Selecione Vendedor</option>
                  @foreach ($vendedors as $vendedor)
                    <option value="{{$vendedor->id}}">{{$vendedor->nome}}</option>
                  @endforeach                
                </select>
              </div>
            </div>
            <hr style="color: brown">
            </p>
            <h5 class="modal-title" id="modalCenterTitle">
        
              Valores e Prazos
            </h5>
             </p>
            <div class="row gy-3">
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Inicio Contrato</label>
                <input
                type="date"
                class="form-control"
                id="inicio_contrato"
                name="inicio_contrato"
                aria-describedby="basic-icon-default-fullname2"
              />
                
              </div>
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Valor Contrato</label>
                <span>R$</span>
                <input type="number" id="valor_contrato" name="valor_contrato" step="0.01" min="0" placeholder="0.00" class="form-control" required>
              </div>
            </div>
            </p>
            <div class="row gy-3">
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Primeiro Pagamento</label>
                <input type="date" id="primeiro_pagamento" name="primeiro_pagamento" step="0.01" min="0" placeholder="00/00/0000" class="form-control" required>
              </div>
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Quant. meses</label>              
                <input type="number" id="quant_meses" name="quant_meses" step="0.01" min="0" placeholder="00" class="form-control" required>
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

        var id_produto= $(clickedButton).data('id_produto');
        
        var id_regra = $(clickedButton).data('id_regra');


        var id_unidade=$(clickedButton).data('id_unidade');
        var id_vendedor=$(clickedButton).data('id_vendedor');
        var id_cliente=$(clickedButton).data('id_cliente');
        var valor_contrato=$(clickedButton).data('valor_contrato');
        var inicio_contrato=$(clickedButton).data('inicio_contrato');
        var primeiro_pagamento=$(clickedButton).data('primeiro_pagamento');
        var quant_meses=$(clickedButton).data('quant_meses');
        var forma_pagamento=$(clickedButton).data('forma_pagamento');
        var parcelas=$(clickedButton).data('parcelas'); 


        
        $('#modalCenterEdit #id').val(id);
        $('#modalCenterEdit #nome').val(nome);
        $('#modalCenterEdit #regra').val(id_regra);
        $('#modalCenterEdit #id_produto').val(id_produto);



        $('#modalCenterEdit #id_unidade').val(id_unidade);
        $('#modalCenterEdit #id_vendedor').val(id_vendedor);
        $('#modalCenterEdit #id_cliente').val(id_cliente);
        $('#modalCenterEdit #valor_contrato').val(valor_contrato);
        $('#modalCenterEdit #inicio_contrato').val(inicio_contrato);
        $('#modalCenterEdit #primeiro_pagamento').val(primeiro_pagamento);
        $('#modalCenterEdit #quant_meses').val(quant_meses);
        $('#modalCenterEdit #forma_pagamento').val(forma_pagamento);
        $('#modalCenterEdit #parcelas').val(parcelas);



        
      }
  </script>