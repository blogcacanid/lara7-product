@extends('base')
@section('main')
<div class='container py-4'>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"><i class="fas fa-edit"></i>&nbsp;Edit Record</div>
                <div class="card-body" style="font-style: Calibri;font-size:13px">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <br /> 
                    @endif
                    <form method="post" action="{{ route('products.update', $data['id']) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" class="form-control" name="product_name" value="{{ $data['product_name'] }}" />
                        </div>
                        <div class="form-group">
                            <label for="product_price">Product Price:</label>
                            <input type="text" class="form-control" name="product_price" value="{{ $data['product_price'] }}" />
                        </div>
                        <a href="{{ route('products.list')}}" class="btn btn-secondary btn-sm" title="Back"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a>&nbsp;
                        <button type="submit" class="btn btn-primary btn-sm" title="Update now"><i class="fas fa-save"></i>&nbsp;Update</button>
                    </form>
                <div>
            <div>
        <div>
    </div>
</div>
@endsection