@extends('layouts.menu')
@section('conteudo')

<?php
$teste='teste';
?>
 <div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">Funcionarios</h5>
        </div>
        <div class="col-auto">
            <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCenter"
            
        >
            Adicionar Funcionario
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
            <th>Cargo</th>
            <th>Contato</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $item)
                
            
          <tr>
            <td><strong>{{$item->id}}</strong>
          </td>     
            <td>{{$item->nome}}</td>  
            <td>{{$item->cargo->nome}}</td>  
            <td>{{$item->contato}}</td>                    
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <button type="button" class="dropdown-item btn-edit" onclick="funcao1(this)" 
                  data-id="{{$item->id}}" 
                  data-nome="{{$item->nome}}"
                  data-contato="{{$item->contato}}"
                  data-id_cargo="{{$item->id_cargo}}"
                  data-email="{{$item->email}}"
                  data-password="{{$item->password}}"
                  data-perc_comissao="{{$item->perc_comissao}}"




                  data-bs-toggle="modal" 
                  data-bs-target="#modalCenterEdit">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                  </button>
                  <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir o produto?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a
                  >

                  <form id="delete-form-{{ $item->id }}" action="{{ route('funcionarios.destroy', ['id'=> $item->id]) }}" method="POST" style="display: none;">
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
            <th>Cargo</th>
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
      
            Novo Funcionario
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
            <form method="POST" action="{{ route('inserir.funcionario') }}">
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
                <label class="form-label" for="basic-icon-default-company">Porcentagem:</label>
                <div class="input-group input-group-merge">
                  <input type="number" id="perc_comissao" name="perc_comissao" min="0" max="100" step="0.01" class="form-control">
                  <span>%</span>
                </div>
              </div>              
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-phone">Contato(Tel:)</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-phone2" class="input-group-text"
                    ><i class="bx bx-phone"></i
                  ></span>
                  <input
                    type="text"
                    id="contato"
                        name="contato"
                    class="form-control phone-mask"
                    placeholder="658 799 8941"
                    aria-label="658 799 8941"
                    aria-describedby="basic-icon-default-phone2"
                  />
                </div>
              </div>             
              <div class="mb-3">
                <label for="defaultSelect" class="form-label">Cargo</label>
                <select id="cargo"  name="cargo" class="form-select" onchange="obterOpcaoSelecionada()">
                  <option>Selecione cargo</option>
                  @foreach ($cargos as $cargo)
                  <option value="{{$cargo->id}}">{{$cargo->nome}}</option>
                  @endforeach
                  
                </select>
              </div>
              {{-- lider --}}
              <div class="mb-3" style="display: none;" id="exibirLider">
                <label for="defaultSelect" class="form-label">Lider</label>
                <select id="lider"  name="lider" class="form-select" onchange="obterOpcaoSelecionada()">
                  <option>Selecione Lider</option>
                  @foreach ($liders as $lider)
                  <option value="{{$lider->id}}">{{$lider->nome}}</option>
                  @endforeach
                  
                </select>
              </div>
              {{-- lider --}}
          </div>
          <div class="row">
              <h5 class="modal-title" id="modalCenterTitle">    
                Dados de acesso
              </h5>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Senha</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
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
            Novo Funcionario
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
            <form method="POST" action="{{ route('funcionarios.update') }}">
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
                      type="text"
                      id="id"
                      name="id"
                      
                    />
                    </div>
                  </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-company">Porcentagem:</label>
                <div class="input-group input-group-merge">
                  <input type="number" id="perc_comissao" name="perc_comissao" min="0" max="100" step="0.01" class="form-control">
                  <span>%</span>
                </div>
              </div>              
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-phone">Contato(Tel:)</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-phone2" class="input-group-text"
                    ><i class="bx bx-phone"></i
                  ></span>
                  <input
                    type="text"
                    id="contato"
                        name="contato"
                    class="form-control phone-mask"
                    placeholder="658 799 8941"
                    aria-label="658 799 8941"
                    aria-describedby="basic-icon-default-phone2"
                  />
                </div>
              </div>             
              <div class="mb-3">
                <label for="defaultSelect" class="form-label">Cargo</label>
                <select id="cargo"  name="cargo" class="form-select" onchange="obterOpcaoSelecionada()">
                  <option>Selecione cargo</option>
                  @foreach ($cargos as $cargo)
                  <option value="{{$cargo->id}}">{{$cargo->nome}}</option>
                  @endforeach
                  
                </select>
              </div>
              {{-- lider --}}
              <div class="mb-3" style="display: none;" id="exibirLider">
                <label for="defaultSelect" class="form-label">Lider</label>
                <select id="lider"  name="lider" class="form-select" onchange="obterOpcaoSelecionada()">
                  <option>Selecione Lider</option>
                  @foreach ($liders as $lider)
                  <option value="{{$lider->id}}">{{$lider->nome}}</option>
                  @endforeach
                  
                </select>
              </div>
              {{-- lider --}}
          </div>
          <div class="row">
              <h5 class="modal-title" id="modalCenterTitle">    
                Dados de acesso
              </h5>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Senha</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
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
  {{-- fim modal Edit --}}



  @endsection


    <script>
      function funcao1(clickedButton)
      {
        var id = $(clickedButton).data('id');
        var nome = $(clickedButton).data('nome');
        var contato = $(clickedButton).data('contato');
        var id_cargo = $(clickedButton).data('id_cargo');
        var email = $(clickedButton).data('email');
        var password = $(clickedButton).data('password');
        var perc_comissao = $(clickedButton).data('perc_comissao');
        var id_cargo = $(clickedButton).data('id_cargo');
        
        $('#modalCenterEdit #id').val(id);
        $('#modalCenterEdit #nome').val(nome);
        $('#modalCenterEdit #contato').val(contato);
        $('#modalCenterEdit #cargo').val(id_cargo);
        $('#modalCenterEdit #email').val(email);
        $('#modalCenterEdit #password').val(password);
        $('#modalCenterEdit #perc_comissao').val(perc_comissao);        
      }

      function obterOpcaoSelecionada() {
      var select = document.getElementById("cargo");
      var opcaoSelecionada = select.options[select.selectedIndex].value;
      //alert("Opção selecionada: " + opcaoSelecionada);
        // Verifica se a opção selecionada é "opcao1"
        if (opcaoSelecionada === "2") {
        // Exibe a div
        document.getElementById("exibirLider").style.display = "block";
      } else {
        // Oculta a div se outra opção for selecionada
        document.getElementById("exibirLider").style.display = "none";
      }
    }

  </script>