@extends('admin.layouts.app')
@section('panel')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $pageTitle }}</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $totalPassword }}</h3>
                <p>Total App Password</p>
              </div>
              <div class="icon">
               <i class="text-muted fas fa-key"></i>
              </div>
              <a href="{{ route('admin.app.index') }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection