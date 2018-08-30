@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                About
            </div>
            <div class="card-body">
                <h2>{{ $order->product->name }}</h2>
                <p>{{ $order->amount }}</p>
                <p>{{ $order->price }}</p>
                @if(auth()->user() && auth()->user()->can("delete-orders"))
                    <button type="button" class="btn btn-sm btn-danger" data-order-id="{{ $order->id }}" data-toggle="modal" data-target="#deleteOrderModal">
                        <i class="far fa-trash-alt"></i>Delete
                    </button>
                @endif

                @if(auth()->user() && auth()->user()->can("update-orders"))
                    <a class="btn btn-sm btn-warning" href="{{ route('order.edit', ['id' => $order->id]) }}">
                        <i class="far fa-edit"></i>Edit
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('extra')
    <!-- Delete Order Modal -->
    <div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOrderModalLabel">Delete Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('order.destroy', ['id' => 0]) }}" method="post" id="deleteOrderForm">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
