@extends('dashboard.layout.main')

@section('title', 'Dashboard')

@section('style')
    <style>
        .table-img img {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
@endsection


@section('content')
   <div class="content-section">
                                <h5 >Welcome to {{config("app.name")}}</h5>

    </div>

@endsection

