@extends('base')
@section('main')
<div class='container py-4'>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"><i class="fas fa-trash"></i>&nbsp;Delete Record</div>
                <div class="card-body" style="font-style: Calibri;font-size:13px">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th width="120">Product Name</th>
                                <td>{{ $data['product_name'] }}</td>
                            </tr>
                            <tr>
                                <th>Product Price</th>
                                <td>{{ number_format($data['product_price']) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Are you sure delete this record ?</b></p>
                    <table>
                        <tr>
                            <td><a href="{{ route('products.list')}}" class="btn btn-secondary btn-sm" title="Back"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Cancel</a></td>
                            <td><a href="{{ route('product.destroy', $data['id'])}}" class="btn btn-danger btn-sm" title="Back"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
                        <tr>
                    </table>    
                <div>
            <div>
        <div>
    </div>
</div>
@endsection