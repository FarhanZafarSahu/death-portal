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
                <th>Form Name</th>
                <th>Visibility</th>
              </tr>
            </thead>
            <tbody>
                @php 
                $i = 1;
                @endphp
              @foreach($form as $forms)
              <tr>
                <td class="text-bold-500">{{$i++}}</td>
                <td><a href="{{route('profile.form.show', ['id' => $forms->id])}}">{{$forms->form->name}}</a></td>
                <td class="text-bold-500">{{$forms->form->visibility}}</td>
              </tr>
              @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection