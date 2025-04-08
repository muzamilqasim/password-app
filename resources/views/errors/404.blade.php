@extends('admin.layouts.master')
@section('content')
<section class="content">
    <div class="container mt-5 text-center">     
        <img src="{{ getImage(getFilePath('errors').'/404.png') }}" alt="404 Error" width="30%" class="img-fluid">
        <h1 class="display-4">Page Not Found!</h1> 
</div>
</section>
@endsection
