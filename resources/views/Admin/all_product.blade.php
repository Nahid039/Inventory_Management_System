@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Products in Stock
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Unit Price</th>
                        <th>Sale Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @php( $i=0 )
                <tbody>
                	@foreach($products as $row)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $row->code }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->category }}</td>
                        
                        @if($row->stock > '0')
                            <td>{{ $row->stock }}</td>
                        @else
                            <td>stockout</td>
                        @endif

                        <td>{{ $row->unit_price }}</td>
                        <td>{{ $row->sales_unit_price }}</td>
                        <td>
                        	
                            {{-- <a href="{{ 'product/delete/'.$row->id }}" class="btn btn-sm btn-danger">Delete</a> --}}

                            <form  action="{{ route('product.delete', $row->id) }}" method="post">
                                {{ csrf_field() }} @method('delete')
                                <a href="{{ 'product/edit/'.$row->id }}" class="btn btn-sm btn-warning">Edit</a>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection