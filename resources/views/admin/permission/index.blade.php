@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row ">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">All Permissions</li>
              </ol>
            </nav>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif

         
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
           
            <tbody>
                @if(count($permissions)>0)
                @foreach($permissions as $key=>$permission)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$permission->role->name}}</td>
                    <td>
                        @if(isset(auth()->user()->role->permission['name']['user']['can-edit']))
                        <a href="{{route('permissions.edit',[$permission->id])}}"><i class="fas fa-edit"></i></a>
                        @endif
                    </td>
                    <td>
                        @if(isset(auth()->user()->role->permission['name']['permission']['can-delete']))
                        <form id="delete-form{{$permission->id}}" method="POST"
                            action="{{route('permissions.destroy', [$permission->id])}}">@csrf
                            {{method_field('DELETE')}}
                        </form>
                            <a href="" onclick="if(confirm('Do you want to delete?')){
							    event.preventDefault();
							    document.getElementById('delete-form{{$permission->id}}').submit();
							    } else {
							        event.preventDefault();
								}
								">
                                <i class="fas fa-trash"></i>
							</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @else
                <td>No permissions to display</td>
                @endif
               
               
              
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection