@extends('layouts.adminlayout');
@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Forms</h4>
                </div>
                <div class="card-content">
                    <a href="{{route('add.forms')}}" class="btn btn-primary ml-4">Add New</a>
                    <!-- table striped -->
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>NAME</th>
                                <th>VISIBILITY</th>
                                <th>STATUS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($forms)
                                @foreach($forms as $form)
                                    <tr>
                                        <td class="text-bold-500">{{$form->name}}</td>
                                        <td>{{$form->visibility}}</td>
                                        <td class="text-bold-500">{{$form->status}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection