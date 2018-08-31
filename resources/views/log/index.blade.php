@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Logs</h4>
            </div>
            <div class="card-body">
                <table class="table" id="log-table-js">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sql</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <th scope="row">{{ $log->id }}</th>
                                <td>{{ $log->sql }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
