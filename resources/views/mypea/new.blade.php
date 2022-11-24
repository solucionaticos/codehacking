@extends('layaouts.app')

@section('title')
    New Record of {{$table}}
@endsection

@section('head')

@endsection

@section('content')

    <div class='mt-4 p-5 bg-primary text-white rounded mb20'>
        <h1>
            <a href='{{$url_base}}'>Table List</a>::Table: <a href='{{$url_base}}/{{$table}}'>{{$table}}</a>::New Record
        </h1>
    </div>

@if ($errors->any())
    <div class = "alert alert-danger">
       <ul>
          @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
          @endforeach
       </ul>
    </div>
 @endif

    <div class="card">
        <div class="card-header"><b>New Record (*)</b></div>
        <div class="card-body bg-light">

            {!! Form::open(['method'=>'POST', 'url'=>'mypea/insert']) !!}

            <?php
            // {!! Form::open(['method'=>'POST', 'action'=>'MypeaController@insert']) !!}
            // echo Form::open(array('url' => 'mypea/insert'));
            echo Form::hidden('table_name', $table);
            ?>

                <div class="row mb20">
                    <div class="col-sm-12 text-right">
                        <a href="{{$url_base}}/{{$table}}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

                @foreach ($fields as $item)
                    <div class="mb-3">
                        {!! Form::label($item, ucwords($item)) !!}
                        {!! Form::text($item, null, ['class'=>'form-control']) !!}
                        <?php
                        // echo Form::label($item, $item);
                        // echo Form::text($item, '', ['class'=>'form-control']);
                        ?>
                    </div>
                @endforeach

                <div class="row mt20">
                    <div class="col-sm-12 text-right">
                        <a href="{{$url_base}}/{{$table}}" class="btn btn-outline-secondary">Cancel</a>
                        {{-- <button type="submit" class="btn btn-success">Submit</button> --}}
                        {!! Form::submit('Submit', ['class'=>'btn btn-success']) !!}
                    </div>
                </div>

            <?php
            // echo Form::close();
            ?> 
            {!! Form::close() !!}       

        </div>
    </div>

@endsection

@section('footer')

@endsection
