@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-2">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New Order</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('neworder.insert') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmail">Customer Email</label>
                                        <select class="form-control" name="email">
                                           <option selected value="">--Select--</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="small mb-1" for="inputState">Product Code</label>
                                      <select id="inputState" name="code" class="form-control ajax-select"  data-url="{{ url('/ajax/product/price/') }}" data-target="#unit_price">
                                        <option selected disabled>--Select--</option>
                                        @foreach($products as $product)
                                            @if( $product->stock > 1)
                                                <option value="{{ $product->id }}">{{ $product->code }}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                      @error('code')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Unit Price</label>
                                        <input id="unit_price" class="form-control" name="unit_price" type="number" value="" readonly/>
                                        @error('unit_price')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Quantity</label>
                                        <input id="quantity" class="form-control input" name="quantity" type="number"/>
                                        @error('quantity')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Total Price</label>
                                        <input id="total_price" class="form-control" name="total_price" type="number" readonly/>
                                        @error('total_price')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
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