@extends('layouts.userlayout');
@section('content')
<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">All Profiles</h4>
      </div>
      <div class="card-content">
        <!-- table striped -->
        <div class="table-responsive">
        @if(Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
        @endif
        @php
        $profile = auth()->user()->profile;
        @endphp
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                @isset($profile->phone_number)
                <th>Phone </th>
                @endisset
                @isset($profile->address)
                <th>Address </th>
                @endisset
                <th>Primary </th>
                <th>Secendory </th>
              </tr>
            </thead>
            <tbody>
            @isset($profile)
              @foreach($profile as $profiles)
              <tr>
                <td class="text-bold-500">{{$profiles->id}}</td>
                <td>{{$profiles->name}}</td>
                <td class="text-bold-500">{{$profiles->email}}</td>
                @isset($profile->phone_number)
                <td>{{$profiles->phone_number }}</td>
                @endisset
                @isset($profiles->address)
                <td>{{$profiles->address}}</td>
                @endisset
                @if($profiles['pivot']->primary != 1)
                <td><a href="{{route('update.profile.primary',['id' => $profiles->id] )}}" class="btn btn-primary" >Make Primary</a></td>
                @endif
                @if($profiles['pivot']->primary == 1)
                <td><button class="btn btn-primary">Primary</button></td>
                @endif
                @if($profiles['pivot']->secondary != 1)
                <td><a href="{{route('update.profile.secondary', ['id' => $profiles->id])}}" class="btn btn-warning" >Make Secendory</a></td>
                @endif
                @if($profiles['pivot']->secondary == 1)
                <td><button class="btn btn-warning">Secondary</button></td>
                @endif
              </tr>
              @endforeach
            @endisset
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection