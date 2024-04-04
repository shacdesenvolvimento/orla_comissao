
@extends('layouts.menu')
@section('conteudo')


<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    
    <!-- Inclua o DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
    <!-- Inclua o DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <!-- Inclua o DataTables ColSearch Extension JavaScript (se estiver usando) -->
    <script src="https://cdn.datatables.net/colsearch/1.3.0/js/dataTables.colSearch.min.js"></script>
<?php
$teste='teste';
?>
 <div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">Pagamentos vendedor</h5>
        </div>
      {{--   <div class="col-auto">
            <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCenter"
            
        >
            Adicionar Cliente
            </button>

          
        </div> --}}
</div>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="table-responsive text-nowrap">
      <table class="table" id="tablePagaVendedor">
        <thead >
          <tr>           
              <th style="text-align: center">Codigo contrato<br>
                <input type="text" class="form-control column_search" id="colSearch_codigo_contrato">
              </th>
              <th>Vendedor<br><input type="text" class="form-control column_search" id="colSearch_vendedor"></th>
              <th>Valor receber<br><input type="text" class="form-control column_search" id="colSearch_valor_receber"></th>
              <th>Status<br><input type="text" class="form-control column_search" id="colSearch_status"></th>
              <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($Pagarvendedor as $item)
            
          <tr>
            
            <td style="text-align: center">{{$item->id_contrato}}</td>      
            <td>{{$item->vendedor->nome}}</td>  
            <td>{{$item->valor_comissao_atual}}</td>  
            <td>{{$item->status}}</td>                    
            <td>
              <div class="dropdown">
                <form method="POST" action="{{ route('pagarvendedor.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                @if ($item->status=='pendente')
                <button type="submit" class="dropdown-item btn-edit" >
                    <i class="fa-solid fa-circle-dollar-to-slot fa-lg" style="color: green;"></i>Pagar
                  </button>
                @else
                <button type="submit" class="dropdown-item btn-edit"  disabled>
                    <i class="fa-solid fa-circle-dollar-to-slot fa-lg" style="color: green;"></i>Pagar
                  </button>
                @endif
                </form>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot class="table-border-bottom-0">
          <tr>
            <th style="text-align: center">Codigo contrato<br><input type="text" class="form-control column_search" id="colSearch_codigo_contrato"></th>
            <th>Vendedor<br><input type="text" class="form-control column_search" id="colSearch_vendedor"></th>
            <th>Valor receber<br><input type="text" class="form-control column_search" id="colSearch_valor_receber"></th>
            <th>Status<br><input type="text" class="form-control column_search" id="colSearch_status"></th>
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
            <form method="POST" action="">
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
            <form method="POST" action="">
             
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

  {{-- <script>
    new DataTable('#tablePagaVendedor', {
    layout: {
        topStart: {
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        }
    },
    searching: true 
  });
 </script> --}}

 <script>
 /*  new DataTable('#tablePagaVendedor', {
    layout: {
        topStart: {
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        }
    },
    columnDefs: [
        {
            targets: '_all',
            searchable: true
        }
    ],
    initComplete: function () {
        this.api().columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
              //alert("head");
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );




        } );
    }
});  */

/* 
 $('#tableHead input').on( 'keyup change clear', function () {

new DataTable('#tablePagaVendedor', {
    layout: {
        topStart: {
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        }
    },
    columnDefs: [{
        targets: '_all',
        searchable: true
    }],
    initComplete: function () {
        var that = this;
        $('#tableHead input').on('keyup change clear', function () {
          
            var columnIndex = $(this).closest('th').index();
            alert (columnIndex)
            that.column(columnIndex).search(this.value).draw();
        });
    }
}); */

new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
                }
            },
            columnDefs: [
                {
                    targets: '_all',
                    searchable: true
                }
            ],
            initComplete: function () {
                this.api().columns().every( function () {
                    var that = this;

                    $('input', this.header()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        }); 
</script>
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
 

 