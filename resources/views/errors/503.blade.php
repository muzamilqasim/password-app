@extends('admin.layouts.master')
@section('content')
<section class="content">
    <div class="container mt-5 text-center">
        <img src="{{ getImage(getFilePath('errors').'/503.jpg') }}" alt="503 Error" width="30%" class="img-fluid">
        <h1 class="display-4">We'll Be Back Soon!</h1>
        <p class="lead">Sorry for the interruption, but we're performing some maintenance at the moment. We'll be back online shortly!</p> 
    </div>
</section>
@endsection
