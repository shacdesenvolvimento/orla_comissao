@extends('layouts.menu_financeiro')
@section('conteudo')
<div class="">
    <div class="">
        
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">
      
            Contrato
          </h5>
        
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            onclick="goBack()"
          ></button>
        </div>
        <div class="modal-body">
              <div class="row">
                <form method="POST" action="{{ route('inserir.contrato') }}">
                  <div class="col-mb-3">
                    <label for="defaultSelect" class="form-label">Produto</label>
                   {{--  <select id="id_produto"  name="id_produto" class="form-select">
                      <option>Selecione produto</option>
                      @foreach ($produtos as $produto)
                        <option value="{{$produto->id}}">{{$produto->nome}}</option>
                      @endforeach                
                    </select> --}}
                    <input type="text" name="id_produto" id="id_produto" value="{{$produtos->nome}}" class="form-control"readonly style="width:40%">
                  </div>       
                  </p>
                  <div class="col-mb-3">
                    
                    <label for="defaultSelect" class="form-label">Unidade</label>
                    {{-- <select id="id_unidade"  name="id_unidade" class="form-select">
                      <option>Selecione unidade</option>
                      @foreach ($unidades as $unidade)
                        <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                      @endforeach                
                    </select> --}}
                    <input type="text" name="id_produto" id="id_produto" value="{{$unidades->nome}}" class="form-control"readonly style="width:40%">
                  </div>      
                  </div>
                  <div class="row gy-3">
                    <div class="col-md">
                      <label for="defaultSelect" class="form-label">Cliente</label>
                     {{--  <select id="id_cliente"  name="id_cliente" class="form-select">
                        <option>Selecione Cliente</option>
                        @foreach ($clientes as $cliente)
                          <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @endforeach                
                      </select> --}}
                      <input type="text" name="id_produto" id="id_produto" value="{{$clientes->nome}}" class="form-control"readonly style="width:40%">
                    </div>
                  <div class="col-md">
                    <label for="defaultSelect" class="form-label">Vendedor</label>
                    {{-- <select id="id_vendedor"  name="id_vendedor" class="form-select">
                      <option>Selecione Vendedor</option>
                      @foreach ($vendedors as $vendedor)
                        <option value="{{$vendedor->id}}">{{$vendedor->nome}}</option>
                      @endforeach                
                    </select> --}}
                    <input type="text" name="id_produto" id="id_produto" value="{{$vendedors->nome}}" class="form-control"readonly style="width:40%">
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
                    value="{{$inicio_contrato}}"
                    aria-label="John Doe"
                    aria-describedby="basic-icon-default-fullname2" readonly
                  />
                    
                  </div>
                  <div class="col-md">
                    <label for="defaultSelect" class="form-label">Valor Contrato</label>
                    <span>R$</span>
                    <input type="number" id="valor_contrato" name="valor_contrato" step="0.01" min="0" value="{{$valor_contrato}}" class="form-control" required readonly>
                  </div>
                </div>
                </p>
                <div class="row gy-3">
                  <div class="col-md">
                    <label for="defaultSelect" class="form-label">Primeiro Pagamento</label>
                    <input type="date" id="primeiro_pagamento" name="primeiro_pagamento" step="0.01" min="0" value="{{$primeiro_pagamento}}" class="form-control" required readonly>
                  </div>
                  <div class="col-md">
                    <label for="defaultSelect" class="form-label">Quant. meses</label>              
                    <input type="number" id="quant_meses" name="quant_meses" step="0.01" min="0" value="{{$quant_meses}}" class="form-control" required readonly>
                  </div>
                </div>
                {{-- lista inico --}}
                <hr style="color: brown">
            </p>
            <h5 class="modal-title" id="modalCenterTitle">
        
              Pagamento Realizados
            </h5>
          </p>
          <div class="col-auto">
            <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCenter"
            
        >
            Adicionar Pagamento
            </button>

          
        </div>
          <div class="table-responsive text-nowrap">

            <table class="table">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Valor Parcela</th>
                  <th>Total Pago</th>
                  <th>Parcelas Pagas</th>
      
                </tr>
              </thead>
              <tbody>
                 @foreach ($pagamentoPorContrato as $item) 
                      
                  
                <tr>
                  <td><strong>{{$item->id}}</strong>
                </td>     
                  <td>{{$item->valor_parcela}}</td>  
                  <td>{{$item->total_atual}}</td> 
                  <td>{{$item->quant_parcela_atual}}</td>  
                
                  {{-- <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu"> --}}
                        {{-- <button type="button" class="dropdown-item btn-edit" onclick="funcao1(this)" 
                        data-id="{{$item->id}}" 
                        data-nome="{{$item->nome}}"
                        data-id_regra="{{$item->id_regra}}"
      
      
      
                        data-bs-toggle="modal" 
                        data-bs-target="#modalCenterEdit">
                          <i class="bx bx-edit-alt me-1"></i> Edit
                        </button>
                        <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir o contrato?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a
                        >
      
                        <form id="delete-form-{{ $item->id }}" action="{{ route('contratos.destroy', ['id'=> $item->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form> --}}
                     {{--  </div>
                    </div>
                  </td> --}}
                </tr>
                @endforeach
              </tbody>
              <tfoot class="table-border-bottom-0">
                <tr>
                  
                  <th>Codigo</th>
                  <th>Valor Parcela</th>
                  <th>Total Pago</th>
                  <th>Parcelas Pagas</th>
                </tr>
              </tfoot>
      
              
      
      
      
            </table>
          </div>
            {{-- lista fim --}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="goBack()">
              Close
            </button>
            
              @csrf
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
    
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">
            Novo Pagamento
          </h5>
        
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close" onclick="goBack()">
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form method="POST" action="{{ route('inserir.controleporcontrato') }}" >
             
                  {{-- VALORES DO CONTRATO --}}
                  <input type="hidden" id="id_contrato" name="id_contrato" value="{{$contratos->id}}">
                  <input type="hidden" id="id_vendedor" name="id_vendedor" value="{{$contratos->id_vendedor}}">
                  <input type="hidden" id="id_lider" name="id_lider" value="{{$contratos->id_lider}}">
                  {{-- <input type="text" id="valor_parcela" name="valor_parcela" value="{{$valor_parcela}}"> --}}
                 {{--  <input type="text" id="total_atual" name="total_atual" value=""> --}}
                 {{--  <input type="text" id="quant_parcela_atual" name="quant_parcela_atual" value="{{$quant_parcela_atual}}"> --}}

              </div>
              
        
            <hr style="color: brown">
            </p>
            <h5 class="modal-title" id="modalCenterTitle">
        
              
            </h5>
          </p>
              
             </p>
            <div class="row gy-3">
             
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Valor Parcela</label>
                <span>R$</span>
                <input type="number" id="valor_parcela" name="valor_parcela" step="0.01" min="0" placeholder="0.00" class="form-control" required>
              </div>
              <div class="col-md">
                <label for="defaultSelect" class="form-label">Data Pagamento</label>
                <span>R$</span>
                <input type="date" id="data_pagamento" name="data_pagamento" step="0.01" min="0" placeholder="0.00" class="form-control" required>
              </div>
            </div>
            </p>
            
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
  @endsection
  <script>
    function goBack() {
        window.history.back();
    }
</script>