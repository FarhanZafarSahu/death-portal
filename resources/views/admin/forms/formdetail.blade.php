@extends('layouts.adminlayout');
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$form->name}}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('form.update', ['id' => $form->id]) }}" method="post">
                    @csrf
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="basicInput">UPDATE Form Name</label>
                            <input type="text" name="name" value="{{$form->name}}" class="form-control" id="basicInput"
                                placeholder="Enter email">
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6>Update Form Visibility</h6>
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="visibility">
                                    <option value="open" @if($form->visibility == 'open') selected @endif>open</option>
                                    <option value="close" @if($form->visibility == 'close') selected @endif>close
                                    </option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6>Update Form Status</h6>
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="status">
                                    <option value="draft" @if($form->status == 'draft') selected @endif>draft</option>
                                    <option value="published" @if($form->status == 'published') selected
                                        @endif>published</option>
                                </select>
                            </fieldset>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <div class="card-header">
                    <h4 class="card-title">{{$form->name}} Fields</h4>
                </div>
                <div class="col-md-8">
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
                            name="{{ $field->name }}" rows="3">Enter your {{ $field->label }}</textarea>
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

                </div>
            </div>
        </div>
    </div>
@endsection