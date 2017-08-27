@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <strong>Error:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="POST" action="{{ route('task') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input class="form-control" id="form-stacked-text" type="text" placeholder="Next Important thing to do..." name="new_task">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>

                </form>
                @if(count($storedTasks)>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>To-Do</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($storedTasks as $storedTask)
                            <tr>
                                <td>{{ $storedTask->task }}</td>
                                <td>
                                    <a href="{{ route('edit', ['task'=> $storedTask->id]) }}">
                                        edit
                                    </a>

                                </td>
                                <td>
                                    <form method="POST" action="{{ route('destroy', ['task'=> $storedTask->id]) }}">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">Delete</button>
                                    </form><br>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">{!!  $storedTasks->render() !!}</div>
                    <div class="col-md-4"></div>

                    @endif
        </div>
    </div>
</div>
@endsection