@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>

    @include('includes.messages')

<table class="table">
    <thead>
        <tr>
            <th>Id</th>

            <th>User</th>
            <th>Category</th>
            <th>Photo</th>

            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
        @if ($posts)
        @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>

            <td>{{$post->user->name}}</td>
            <td>{{$post->category->name}}</td>
            <td>
                <img src="{{ $post->photo ? $post->photo->file : '' }}" height="100px">
            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>


@endsection