@extends('layouts.userlayout');
@section('content')
<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">All Users</h4>
      </div>
      <div class="card-content">
        @if(Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
        @endif
        <!-- table striped -->
        <div class="table-responsive">
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
           
            @isset($users)
              @foreach($users as $user)
              <tr>
                <td class="text-bold-500">{{$user->id}}</td>
                <td>{{$user->first_name}}</td>
                <td class="text-bold-500">{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td><a href="" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ route('death.store',$user->id) }}" class="btn btn-primary">Register Death</a></td>
              </tr>
              @endforeach
            @endisset
          </table>
            @unless($users)
                <tr>
                    <td>
                        <h3 style="text-align:center; margin-top: 10px">No Data Found</h3>
                    </td>
                </tr>
            @endunless
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
          <form action="" method="post" id="death-form">
              @csrf
              <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3" placeholder="Enter your Message here"></textarea><br>
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        // Listen for a click on the "Register Death" button
        $('.btn-primary').on('click', function () {
            var url = $(this).data('url'); // Get the user's id from the data attribute
            var form = $('#death-form');
            console.log(form);
            form.attr('action', url); // Update the form action with the user's id
        });
    });
</script>
@endsection