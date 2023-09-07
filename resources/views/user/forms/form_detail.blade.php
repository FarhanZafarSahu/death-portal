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
                                @foreach($data as $key=>$value)
                                  <th>{{$key}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($data as $value)
                                  <td class="text-bold-500">{{$value}}</td>
                                @endforeach
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection