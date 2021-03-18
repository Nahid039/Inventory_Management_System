@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create New Invoice</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/insert-invoice') }}" enctype="multipart/form-data">
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
                                      <label class="small mb-1" for="inputState">Product Category</label>
                                      <select id="inputState" name="item" class="form-control">
                                        <option selected>Choose...</option>
                                        @foreach($products as $row)
                                            @if( $row->stock > 1)
                                                <option>{{ $row->category }}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="small mb-1" for="inputState">Product Name</label>
                                      <select id="inputState" name="name" class="form-control">
                                        <option selected>Choose...</option>
                                        @foreach($products as $row)
                                            @if( $row->stock > 1)
                                                <option>{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Price (perUnit)</label>
                                        <input class="form-control py-4" name="unit_price" type="text"  />
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Quantity</label>
                                        <input class="form-control py-4" name="quantity" type="text"  />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Total Price</label>
                                        <input class="form-control py-4" name="total" type="text"  />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Payment</label>
                                        <input class="form-control py-4" name="payment" type="text" placeholder="" />
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