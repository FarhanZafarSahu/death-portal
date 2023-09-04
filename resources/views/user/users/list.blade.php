@extends('layouts.userlayout');
@section('content')
<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">All Users</h4>
      </div>
      <div class="card-content">
        <!-- table striped -->
        <div class="table-responsive">
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td class="text-bold-500">{{$user->id}}</td>
                <td>{{$user->first_name}}</td>
                <td class="text-bold-500">{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
              </tr>
              @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection