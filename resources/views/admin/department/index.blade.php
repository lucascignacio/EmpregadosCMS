@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row ">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">All Departments</li>
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
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                </tr>
            </thead>
           
            <tbody>
                @if(count($departments)>0)
                @foreach($departments as $key=>$department)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$department->name}}</td>
                    <td>{{$department->description}}</td>
                    <td>
                        @if(isset(auth()->user()->role->permission['name']['department']['can-edit']))
                        <a href="{{route('departments.edit',[$department->id])}}"><i class="fas fa-edit"></i></a></td>
                    @endif
                    <td>
                        @if(isset(auth()->user()->role->permission['name']['department']['can-delete']))
                        <form id="delete-form{{$department->id}}" method="POST"
                            action="{{route('departments.destroy', [$department->id])}}">@csrf
                            {{method_field('DELETE')}}
                        </form>
                            <a href="" onclick="if(confirm('Do you want to delete?')){
							    event.preventDefault();
							    document.getElementById('delete-form{{$department->id}}').submit();
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
                <td>No departments to display</td>
                @endif
               
               
              
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection