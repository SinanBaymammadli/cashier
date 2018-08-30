@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Purchases</h4>

                @if(auth()->user()->can("create-purchases"))
                    <a class="btn btn-success" href="{{ route('purchase.create') }}">
                        <i class="fas fa-plus"></i>
                        Add new
                    </a>
                @endif
            </div>
            <div class="card-body">
                <table class="table" id="purchase-table-js">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <th scope="row">{{ $purchase->id }}</th>
                                <td>{{ $purchase->product->name }}</td>
                                <td>{{ $purchase->amount }}</td>
                                <td>{{ $purchase->price }}</td>
                                <td>{{ $purchase->created_at }}</td>
                                <td>
                                    @if(auth()->user()->can("delete-purchases"))
                                        <button type="button" class="btn btn-sm btn-danger" data-purchase-id="{{ $purchase->id }}" data-toggle="modal" data-target="#deletePurchaseModal">
                                            <i class="far fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    @endif

                                    @if(auth()->user()->can("update-purchases"))
                                        <a class="btn btn-sm btn-warning" href="{{ route('purchase.edit', ['id' => $purchase->id]) }}">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>
                                    @endif

                                    @if(auth()->user()->can("read-purchases"))
                                        <a class="btn btn-sm btn-info" href="{{ route('purchase.show', ['id' => $purchase->id]) }}">
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
