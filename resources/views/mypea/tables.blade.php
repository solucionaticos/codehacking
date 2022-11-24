@extends('layaouts.app')

@section('title', 'Table List')

@section('content')

<div class='mt-4 p-5 bg-primary text-white rounded' style='margin-bottom:20px;'>
    <h1>
        Table List
    </h1>
</div>

@if (count($errors) > 0)
<div class = "alert alert-danger">
   <ul>
      @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif

<div class='table-responsive'>
    <table class='table table-striped table-bordered table-hover table-dark table-sm'>
        @if (count($columns))
        <thead>
            <tr>
                @foreach ($columns as $item)
                    <th>{{$item}}</th>
                @endforeach
            </tr>
        </thead>
        @endif
        @if (count($rows))
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($row as $item)
                        <td>{!! $item !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        @endif

    </table>
</div>

@endsection
