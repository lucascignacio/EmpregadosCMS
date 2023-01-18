@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row ">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">All Employee</li>
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
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Start Date</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
           
            <tbody>
                @if(count($users)>0)
                @foreach($users as $key=>$user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img src="{{asset('profile')}}/{{$user->image}}" width="50"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><span class="badge bg-success">{{$user->role->name}}</span></td>
                    <td>{{$user->department->name}}</td>
                    <td>{{$user->designation}}</td>
                    <td>{{$user->start_from}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->mobile_number}}</td>
                    <td>
                        @if(isset(auth()->user()->role->permission['name']['user']['can-edit']))
                        <a href="{{route('users.edit',[$user->id])}}"><i class="fas fa-edit"></i></a>
                        @endif
                    </td>
                    <td>
                        @if(isset(auth()->user()->role->permission['name']['user']['can-delete']))
                        <form id="delete-form{{$user->id}}" method="POST"
                            action="{{route('users.destroy', [$user->id])}}">@csrf
                            {{method_field('DELETE')}}
                        </form>
                            <a href="" onclick="if(confirm('Do you want to delete?')){
							    event.preventDefault();
							    document.getElementById('delete-form{{$user->id}}').submit();
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
                <td>No users to display</td>
                @endif
               
               
              
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection