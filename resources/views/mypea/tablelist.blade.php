@extends('layaouts.app')

@section('title')
    Table: {{$table}}
@endsection

@section('head')

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    {!! $head !!}
@endsection

@section('content')

<div class='mt-4 p-5 bg-primary text-white rounded mb20'>
    <h1>
        <a href='{{$url_base}}'>Table List</a>::Table: {{$table}}
    </h1>
</div>


@if (session('mypea_msg_text'))
    <div class="alert alert-{{ session('mypea_msg_color') }}">
        {!! session('mypea_msg_text') !!}
    </div>
@endif

@if ($errors->any())
<div class = "alert alert-danger">
   <ul>
      @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif

<div class="row mb20">
    <div class="col-sm-12">
        <a href="{{$url_base}}/{{$table}}/new" class="btn btn-outline-success">New Record</a>
    </div>
</div>

<div class='table-responsive'>
    <table class='table table-bordered table-hover table-dark table-sm'>
        @if (count($columns))
        <thead>
            <tr>
                <th colspan='2'></th>
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

@section('footer')

<script>

    alertify.defaults = {
        // dialogs defaults
        autoReset:true,
        basic:false,
        closable:false,
        closableByDimmer:true,
        invokeOnCloseOff:false,
        frameless:false,
        defaultFocusOff:false,
        maintainFocus:true, // <== global default not per instance, applies to all dialogs
        maximizable:true,
        modal:true,
        movable:true,
        moveBounded:false,
        overflow:true,
        padding: true,
        pinnable:true,
        pinned:true,
        preventBodyShift:false, // <== global default not per instance, applies to all dialogs
        resizable:true,
        startMaximized:false,
        transition:'pulse',
        transitionOff:false,
        tabbable:'button:not(:disabled):not(.ajs-reset),[href]:not(:disabled):not(.ajs-reset),input:not(:disabled):not(.ajs-reset),select:not(:disabled):not(.ajs-reset),textarea:not(:disabled):not(.ajs-reset),[tabindex]:not([tabindex^=\"-\"]):not(:disabled):not(.ajs-reset)',  // <== global default not per instance, applies to all dialogs

        // notifier defaults
        notifier:{
        // auto-dismiss wait time (in seconds)  
            delay:5,
        // default position
            position:'bottom-right',
        // adds a close button to notifier messages
            closeButton: false,
        // provides the ability to rename notifier classes
            classes : {
                base: 'alertify-notifier',
                prefix:'ajs-',
                message: 'ajs-message',
                top: 'ajs-top',
                right: 'ajs-right',
                bottom: 'ajs-bottom',
                left: 'ajs-left',
                center: 'ajs-center',
                visible: 'ajs-visible',
                hidden: 'ajs-hidden',
                close: 'ajs-close'
            }
        },

        // language resources 
        glossary:{
            // dialogs default title
            title:'AlertifyJS',
            // ok button text
            ok: 'OK',
            // cancel button text
            cancel: 'Cancel'            
        },

        // theme settings
        theme:{
            // class name attached to prompt dialog input textbox.
            input:'ajs-input',
            // class name attached to ok button
            ok:'ajs-ok',
            // class name attached to cancel button 
            cancel:'ajs-cancel'
        },
        // global hooks
        hooks:{
            // invoked before initializing any dialog
            preinit:function(instance){},
            // invoked after initializing any dialog
            postinit:function(instance){},
        },
    };

    function fnDelete(table, id) {

        alertify.confirm('Are you sure you want to delete this record?',
            function(){
                // window.location.href = "http://www.w3schools.com";
                // console.log('{{$url_base}}/' + table + '/' + id + '/delete');
                // alertify.success('Ok');
                window.location.href = '{{$url_base}}/' + table + '/' + id + '/delete';
            },
            function(){
                // console.log('Naranjas: ' + table + ' id: ' + id);
                alertify.error('Cancel');
            }
        );

    }

    </script>

    {!! $footer !!}

@endsection

