
@extends('layouts.menu')
@section('conteudo')

{{-- test --}}


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
<div class="card">
    <div class="row">
        <div class="col">
            <h5 class="card-header">Pagamentos vendedor</h5>
        </div>
    </div>
    <table id="example" class="display nowrap" style="width:100%">
      <thead>
          <tr>
            <th style="text-align: center">Codigo contrato<br><input type="text" class="form-control column_search" id="colSearch_codigo_contrato"></th>
            <th>Vendedor<br><input type="text" class="form-control column_search" id="colSearch_vendedor"></th>
            <th>Valor receber<br><input type="text" class="form-control column_search" id="colSearch_valor_receber"></th>
            <th>Status<br><input type="text" class="form-control column_search" id="colSearch_status"></th>
            <th>Data Liberação<br><input type="text" class="form-control column_search" id="colSearch_data_liberacao"></th>
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
             {{--  <td>{{ date('d-m-Y', strtotime($item->data_liberacao)) }}</td>    --}}    
             <td>{{ date('d \d\e F \d\e Y', strtotime($item->data_liberacao)) }}</td>         
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
      <tfoot>
          <tr>
            <th style="text-align: center">Codigo contrato<br>
              <input type="text" class="form-control column_search" id="colSearch_codigo_contrato">
            </th>
            <th>Vendedor<br><input type="text" class="form-control column_search" id="colSearch_vendedor"></th>
            <th>Valor receber<br><input type="text" class="form-control column_search" id="colSearch_valor_receber"></th>
            <th>Status<br><input type="text" class="form-control column_search" id="colSearch_status"></th>
            <th>Data Liberação<br><input type="text" class="form-control column_search" id="colSearch_data_liberacao"></th>
            <th>Ações</th>
          </tr>
      </tfoot>
  </table>

  <script>
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

</div>

  @endsection


    
 

 