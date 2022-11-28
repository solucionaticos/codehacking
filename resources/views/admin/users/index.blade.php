@extends('layouts.admin')

@section('content')
    <h1>Users</h1>

    @include('includes.messages')

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @if ($users)
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>
                            <img src="{{$user->photo ? $user->photo->file : ''}}" height="50px">
                        </td>
                        <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->is_active ? 'Yes' : 'No' }}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>                
                @endforeach
            @endif
        </tbody>
    </table>

@endsection
