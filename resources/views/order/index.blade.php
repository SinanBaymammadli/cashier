@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Orders</h4>

                @if(auth()->user()->can("create-orders"))
                    <a class="btn btn-success" href="{{ route('order.create') }}">
                        <i class="fas fa-plus"></i>
                        Add new
                    </a>
                @endif
            </div>
            <div class="card-body">
                <table class="table" id="order-table-js">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->price }}</td>
                                <td>
                                    @if(auth()->user()->can("delete-orders"))
                                        <button type="button" class="btn btn-sm btn-danger" data-order-id="{{ $order->id }}" data-toggle="modal" data-target="#deleteOrderModal">
                                            <i class="far fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    @endif

                                    @if(auth()->user()->can("update-orders"))
                                        <a class="btn btn-sm btn-warning" href="{{ route('order.edit', ['id' => $order->id]) }}">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>
                                    @endif

                                    @if(auth()->user()->can("read-orders"))
                                        <a class="btn btn-sm btn-info" href="{{ route('order.show', ['id' => $order->id]) }}">
                                            <i class="far fa-eye"></i>
                                            View
                                        </a>
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
