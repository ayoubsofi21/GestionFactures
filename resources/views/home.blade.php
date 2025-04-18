@extends('layouts.master')

@section('content')
    <head>
        <style>
            .page-content {
                /* background-image: url('{{ asset('assets/images/file.svg') }}'); */
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                max-height:100vh;
    
            }
           
        </style>
    </head>
    <body>
        <div class="page-content">
                 <img   src="{{ asset('assets/images/file.svg') }}" alt="">
        </div>
    </body>
    
@endsection
       


        
