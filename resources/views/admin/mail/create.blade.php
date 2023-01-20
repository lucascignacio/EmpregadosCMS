@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <div class="card">
            <div class="card-header">Send Mail</div>
            <div class="card-body">
                <form action="{{route('mail.store')}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                        <br>
                        <label><h4>Send Mail</h4></label>
                        <div>select</div>
                        <select id="mail" class="form-control">
                            <option value="0">Mail to all staff</option>
                            <option value="1">Choose department</option>
                            <option value="2">Choose person</option>  
                        </select>
                        <br>
                        <select id="department" class="form-control">
                            @foreach(App\Models\Department::all() as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <select id="person" class="form-control">
                            @foreach(App\Models\User::all() as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea name="body" class="form-control @error('body') is-invalid @enderror"></textarea>
                            @error('body')
                                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input name="file" type="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>

        </div>
    </div>
</div>

@endsection