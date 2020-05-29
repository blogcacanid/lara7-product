@extends('base')
@section('main')
<div class="row">
    <div class="col-sm-12">
        <div class="card-body" style="font-style: Calibri;font-size:12px">
            <h3><i class="fas fa-list"></i>&nbsp;List Product</h3>    
            <div>
                <a href="{{ route('product.add')}}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i>&nbsp;Add Record</a>
                <a style="margin: 2px;" href="{{ route('products.list')}}" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i>&nbsp;Refresh</a>
            </div>
            <br />
            @if(session()->get('success'))
                <div class="alert alert-success">
                  {{ session()->get('success') }}  
                </div>
            @endif
            <table class="table table-bordered table-striped data-table" style="font-style: Calibri;font-size:12px">
                <thead>
                    <tr>
                      <th width="40">Actions</th>
                      <th width="20">No.</th>
                      <th>Product Name</th>
                      <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>    
    <div>
</div>
        
<script type="text/javascript">
     $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.list') }}",
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false  },
                { data: 'product_name', name: 'product_name' },
                { data: 'product_price', name: 'product_price', className: 'text-right' },
            ],
            order: [[2, 'asc']],
        });
    });
</script>        
@endsection