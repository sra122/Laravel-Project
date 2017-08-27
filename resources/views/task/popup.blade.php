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
                    @if(session('min_5_char'))
                        <div  id="post_message" class="alert alert-warning">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{session('min_5_char')}}
                        </div>
                    @endif
                    @if(session('empty'))
                        <div  id="post_message" class="alert alert-warning">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{session('empty')}}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('update', ['task'=> $popname->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Task:</label>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="text" name="updatedtask" class="form-control" id="recipient-name" value="{{ $popname->task }}">
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('task') }}" type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection