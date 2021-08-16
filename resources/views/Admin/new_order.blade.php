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
                                
                                
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputName">Customer Name</label>
                                        <input class="form-control" name="name" type="text"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Company</label>
                                        <input class="form-control" name="company" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputState">Address</label>
                                        <input class="form-control" name="address" type="text" />

                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputState">Phone No.</label>
                                        <input class="form-control" name="phone" type="text" />
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="small mb-1" for="inputState">Product Code</label>
                                      <select id="inputState" name="code" class="form-control">
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
                                {{-- <div class="col-md-6">
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
                                </div> --}}
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
                                        <label class="small mb-1" for="inputLastName">Quantity</label>
                                        <input class="form-control" name="quantity" type="text"/>
                                        @error('quantity')
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