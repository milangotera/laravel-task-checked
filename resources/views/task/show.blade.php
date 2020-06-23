@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session()->has('message'))
            <div class="alert alert-dismissible fade show alert-danger" role="alert">
                
                {{ session()->get('message') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        New Task
                    </div>
                    <div class="float-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-primary" title="go back">go back</a>
                    </div>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('task.update', $tasks->id ) }}" method="POST" name="form-task">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $tasks->name }}" class="form-control" id="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="name">Description</label>
                                <input type="text" name="description" value="{{ $tasks->description }}" class="form-control" id="description" placeholder="Description" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="name">Status</label>
                                <select class="custom-select" id="status" name="status">
                                    <option value="0" @if($tasks->status == 0) selected @endif>Pending</option>
                                    <option value="1" @if($tasks->status == 1) selected @endif>Completed</option>
                                </select>
                            </div>
                        </div>
                        <a href="{{ route('task.delete', ['id' => $tasks->id ] ) }}" class="btn btn-sm btn-danger float-left" title="delete">delete</a>
                        <button class="btn btn-primary float-right" type="submit">New</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection