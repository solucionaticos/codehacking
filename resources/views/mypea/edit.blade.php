@extends('layaouts.app')

@section('title')
    Edit Record of {{$table}}
@endsection

@section('head')

@endsection

@section('content')

    <div class='mt-4 p-5 bg-primary text-white rounded mb20'>
        <h1>
            <a href='{{$url_base}}'>Table List</a>::Table: <a href='{{$url_base}}/{{$table}}'>{{$table}}</a>::Edit Record
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

    <div class="card">
        <div class="card-header"><b>New Record</b></div>
        <div class="card-body bg-light">

            <?php
            echo Form::open(array('url' => 'mypea/update', 'method' => 'PUT'));
            echo Form::hidden('table_name', $table);
            echo Form::hidden('id', $id);
            ?>

                <div class="row mb20">
                    <div class="col-sm-12 text-right">
                        <a href="{{$url_base}}/{{$table}}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

                @foreach ($fields as $item)
                    <div class="mb-3">
                        <?php
                        echo Form::label($item, $item);
                        echo Form::text($item, $values[$item], ['class'=>'form-control']);
                        ?>
                    </div>
                @endforeach

                <div class="row mt20">
                    <div class="col-sm-12 text-right">
                        <a href="{{$url_base}}/{{$table}}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

            <?php
            echo Form::close();
            ?>        
                    
        </div>
    </div>

@endsection

@section('footer')

@endsection
