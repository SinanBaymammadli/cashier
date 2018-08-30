@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="m-0">Create new purchase</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('purchase.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="product_id" class="col-md-4 col-form-label text-md-right">Product</label>

                        <div class="col-md-6">
                            <select class="custom-select form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if($errors->has('product_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('product_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-md-4 col-form-label text-md-right">Amount</label>

                        <div class="col-md-6">
                            <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" required/>

                            @if($errors->has('amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                        <div class="col-md-6">
                            <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" required/>

                            @if($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
