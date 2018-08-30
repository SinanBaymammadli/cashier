@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                About
            </div>
            <div class="card-body">
                <h2>{{ $purchase->product->name }}</h2>
                <p>{{ $purchase->amount }}</p>
                <p>{{ $purchase->price }}</p>
                @if(auth()->user() && auth()->user()->can("delete-purchases"))
                    <button type="button" class="btn btn-sm btn-danger" data-purchase-id="{{ $purchase->id }}" data-toggle="modal" data-target="#deletePurchaseModal">
                        <i class="far fa-trash-alt"></i>Delete
                    </button>
                @endif

                @if(auth()->user() && auth()->user()->can("update-purchases"))
                    <a class="btn btn-sm btn-warning" href="{{ route('purchase.edit', ['id' => $purchase->id]) }}">
                        <i class="far fa-edit"></i>Edit
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('extra')
    <!-- Delete Purchase Modal -->
    <div class="modal fade" id="deletePurchaseModal" tabindex="-1" role="dialog" aria-labelledby="deletePurchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePurchaseModalLabel">Delete Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('purchase.destroy', ['id' => 0]) }}" method="post" id="deletePurchaseForm">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
