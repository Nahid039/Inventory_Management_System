@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Invoices List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Company</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                @php( $i=0 )
                <tbody>
                	@foreach($invoices as $row)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $row->customer_name }}</td>
                        <td>{{ $row->company }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection