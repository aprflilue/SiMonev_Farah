{{-- ADMIN PUSAT  --}}
@extends('dashboard.layouts.main')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
@endpush

@section('container')

@include('sweetalert::alert')

<section class="section">
  <div class="section-header">
    <h1><i class="fa fa-users"></i> {{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="/dashboard">Dashboard</a></div>
      <div class="breadcrumb-item">{{ $title }}</div>
    </div>
  </div>
</section>

<div class="card card-primary shadow mb-4">
  <div class="card-header py-3">
    @can('pusat')
      <button type="button" class="btn btn-icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Tambah Admin</button>
    @endcan
    @can('provinsi')
      <button type="button" class="btn btn-icon icon-left btn-secondary" data-toggle="tooltip" title="Akses Ditutup" disabled><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Tambah Admin</button>
    @endcan
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="dataTable">
        <thead class="table-success">
          <tr>
            <th class="text-center" scope="row">No.</th>
            <th class="text-center" scope="row">Name</th>
            <th class="text-center" scope="row">Username</th>
            <th class="text-center" scope="row">Email</th>
            <th class="text-center" scope="row">Password</th>
            @can('pusat')
              <th class="text-center" scope="row">Action</th>
            @endcan
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <th scope="row">{{$loop->iteration}} </th>
            <td>{{$user->name}} </td>
            <td>{{$user->username}} </td>
            <td>{{$user->email}} </td>
            <td>******</td>
            
            @can('pusat')
              <td style="font-size: 22px;">
                <a href="/dashboard/users/{{ $user->id }}/edit" class="edituser btn btn-icon btn-info" id="edituser" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#edituser"><i class="far fa-edit"></i></a>&nbsp;
                <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-icon btn-danger" onclick="return confirm('Hapus data user?')"><i class="fas fa-trash"></i></button>
                </form>
              </td>  
            @endcan
            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
</div>
@extends('dashboard.partials.addUserModal')
@extends('dashboard.partials.editUserModal')
@endsection

@push('script')
  <script src="/js/edituser.js"></script>
@endpush