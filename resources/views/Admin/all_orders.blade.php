@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Orders List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Customer Email</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php( $i=0 )
                    @foreach($orders as $row)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->customer_email }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->total_price }}</td>
                        <td>
                            @if($row->order_status=='0')
                                <a href="#" class="btn btn-sm btn-danger">Pending</a>
                            @else
                                <a href="#" class="btn btn-sm btn-info">Delivered</a>
                            @endif
                        </td>
                        <td>
                            @if($row->order_status=='0')
                                <a href="{{ 'add-invoice/'.$row->order_id }}" class="btn btn-sm btn-danger">createInvoice</a>
                            @else
                                <a href="#" class="btn btn-sm btn-info">Invoiced</a>
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection