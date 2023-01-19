@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-20">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">All Notices</li>
              </ol>
            </nav>
            @if(count($notices)>0)
            @foreach($notices as $notice)
            <div style="background-color:lightslategrey">
                <div class="card-header" style="color:rgb(0, 0, 0);">{{$notice->title}}</div>

                <div class="card-body" style="color:black;">
                    <p>{{$notice->description}}</p>
                    <p class="badge bg-success">Data:{{$notice->date}}</p>
                     <p class="badge bg-warning">Created By:{{$notice->name}}</p>
                </div>
                <div>
                    @if(isset(auth()->user()->role->permission['name']['notice']['can-edit']))
                    <a href="{{route('notices.edit',[$notice->id])}}"><i class="fas fa-edit"></i></a></div>
                @endif
                <div>
                    @if(isset(auth()->user()->role->permission['name']['notice']['can-delete']))
                    <form id="delete-form{{$notice->id}}" method="POST"
                        action="{{route('notices.destroy', [$notice->id])}}">@csrf
                        {{method_field('DELETE')}}
                    </form>
                        <a href="" onclick="if(confirm('Do you want to delete?')){
                            event.preventDefault();
                            document.getElementById('delete-form{{$notice->id}}').submit();
                            } else {
                                event.preventDefault();
                            }
                            ">
                            <i class="fas fa-trash"></i>
                        </a>
                    @endif
                    </div>
            </div>
            @endforeach

            @else
            <p>No notices created yet</p>
            @endif

        </div>
    </div>
</div>
@endsection