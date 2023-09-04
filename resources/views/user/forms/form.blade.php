@extends('layouts.userlayout');
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$form->name}}</h4>
        </div>
        @if(Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('user.form.submit', ['id' => $form->id]) }}" method="post">
                        @csrf
                        @if(isset($form))
                        @foreach($form->formFields as $field)
                        <div class="form-group">
                            @if($field->type != 'button' && $field->type != 'textarea' && $field->type != 'select')
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            <input type="{{ $field->type }}" class="form-control" id="{{ $field->name }}"
                                name="{{ $field->name }}" placeholder="Enter your {{ $field->label }}"><br>
                            @endif

                            @if($field->type == 'textarea')
                            <label for="{{ $field->name }}" class="form-label">{{ $field->label }}</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" id="{{ $field->name }}"
                                name="{{ $field->name }}" rows="3"></textarea>
                            @endif
                            @if($field->type == 'select')
                            <div class="col-md-6 mb-4">
                                <h6>{{ $field->label }}</h6>
                                <fieldset class="form-group">
                                    <select class="form-select" id="basicSelect" name="{{ $field->name }}">
                                        <option>IT</option>
                                        <option>Blade Runner</option>
                                        <option>Thor Ragnarok</option>
                                    </select>
                                </fieldset>
                            </div>
                            @endif
                            @if($field->type == 'button')
                            <button type="submit" class="btn btn-primary">{{ $field->label }}</button>
                            @endif
                        </div>
                        @endforeach
                        @endisset
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection