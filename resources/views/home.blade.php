@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        Task
                    </div>
                    <div class="float-right">
                    <a href="{{ route('task.create', ['id' => 0] ) }}" class="btn btn-sm btn-primary" title="New">New</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Show</th>
                        </tr>
                        </thead>
                    <tbody>
                         @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{  $task->id }}</th>
                            <td>{{  $task->name }}</td>
                            <td>{{  $task->description }}</td>
                            <td>{{  ($task->status == 1) ? 'Completed' : 'Pending' }}</td>
                            <td>
                                <a href="{{ route('task.show', ['id' => $task->id ] ) }}" class="btn btn-sm btn-primary" title="Show">Show</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
