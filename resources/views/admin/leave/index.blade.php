@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <table class="table mt-5">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Date from</th>
                            <th scope="col">Date To</th>
                            <th scope="col">Description</th>
                            <th scope="col">type</th>
                            <th scope="col">Status</th>
                          
                            <th scope="col">Approve/Reject</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($leaves as $leave)
                          <tr>
                            <td>{{$leave->user->name}}</td>
                            <td>{{$leave->from}}</td>
                            <td>{{$leave->to}}</td>
                            <td>{{$leave->description}}</td>
                            <td>{{$leave->type}}</td>
                            <td>
                                @if($leave->status==0)
                                <span class="alert alert-danger">pending</span>
                                @else
                                <span class="alert alert-success">Approved</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{route('status', [$leave->id])}}" method="POST">@csrf
                                {{method_field("PUT")}}
                                    @if($leave->status==0)
                                    <select class="form-control" name="status" required="">
                                        <option value="0">Reject</option>
                                        <option value="1">Accept</option>
                                    </select>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                    @endif
                                </form>
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

@if(isset(auth()->user()->role->permission['name']['department']['can-edit']))
<button type="submit" class="btn btn-primary">Update</button>
@endif