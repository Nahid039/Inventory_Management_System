@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create New Invoice</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('invoice.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Customer Name</label>
                                        <input class="form-control py-4" name="customer" type="text"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Customer Email</label>
                                        <input class="form-control py-4" name="email" type="text"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Company</label>
                                        <input class="form-control py-4" name="company" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputState">Address</label>
                                        <input class="form-control py-4" name="address" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputState">Phone No.</label>
                                        <input class="form-control py-4" name="phone" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="small mb-1" for="inputState">Product Code</label>
                                      <select id="inputState" name="code" class="form-control ajax-select"  data-url="{{ url('/ajax/product/price/') }}" data-target="#unit_price">
                                        <option selected disabled>Choose...</option>
                                        @foreach($products as $row)
                                            @if( $row->stock > 1)
                                                <option value="{{ $row->id }}">{{ $row->code }}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Price (perUnit)</label>
                                        <input id="unit_price" class="form-control py-4" name="unit_price" type="number" readonly/>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Quantity</label>
                                        <input id="quantity" class="form-control input py-4" name="quantity" type="number"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Total Price</label>
                                        <input id="total_price" class="form-control py-4" name="total" type="number" readonly/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection