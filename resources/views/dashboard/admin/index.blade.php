@extends('dashboard.layouts.main')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
@endpush

@section('container')

@include('sweetalert::alert')

<section class="section">
  <div class="section-header">
    
    <div class="media-body">
      <div class="media-title"><h1><i class="fa fa-users"></i> {{ $title }}</h1></div>
      @can('pusat')
      <span class="text-muted"></span>
      @endcan
      @can('provinsi')
      <span class="text-muted">Provinsi<div class="bullet"></div> <span class="text-primary">{{$provinsi_auth->name}}</span></span>
      @endcan
  </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="/dashboard">Dashboard</a></div>
      <div class="breadcrumb-item">{{ $title }}</div>
    </div>
  </div>
</section>

<div class="card card-primary shadow mb-4">
  <div class="card-header py-3">
    <button type="button" class="btn btn-icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#addAdmin"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Tambah Admin</button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="dataTable">
        <thead class="table-success">
          <tr>
            <th class="text-center" scope="row">No.</th>
            <th class="text-center" scope="row">Name</th>
            <th class="text-center" scope="row">Asal Provinsi</th>
            <th class="text-center" scope="row">Username</th>
            <th class="text-center" scope="row">Email</th>
            <th class="text-center" scope="row">Password</th>
            <th class="text-center" scope="row">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($admins as $admin)
          <tr>
            <th scope="row">{{$loop->iteration}} </th>
            <td>{{$admin->name}} </td>
            <td>{{$admin->provinsi_name}} </td>
            <td>{{$admin->username}} </td>
            <td>{{$admin->email}} </td>
            <td>*******</td>
            <td style="font-size: 22px;">      
              <a href="/dashboard/admin/{{ $admin->id }}/edit" class="edituser btn btn-icon btn-info" id="editadmin" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#editadmin"><i class="fas fa-edit"></i></a>&nbsp;
              <form action="/dashboard/admin/{{ $admin->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-icon btn-danger" onclick="return confirm('Hapus data Admin Provinsi?')"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@extends('dashboard.partials.addAdminModal')
@extends('dashboard.partials.editAdminModal')
@endsection


@push('script')
  <script src="/js/edituser.js"></script>
@endpush