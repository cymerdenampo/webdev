@extends('parent')
@extends('layouts.app')

@section('main')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <h3 align="center"><strong>Edit Contacts</strong></h3>
    <div align="right">
        <a href="{{ route('crud.index') }}" class="btn btn-default">Back</a>
    </div>
    <br />
    <form method="post" action="{{ route('crud.update', $data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label class="col-md-4 text-right">Name</label>
            <div class="col-md-8">
                <input type="text" name="first_name" value="{{ $data->first_name }}" class="form-control input-lg" />
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">Company</label>
            <div class="col-md-8">
                <input type="text" name="company" value="{{ $data->company }}" class="form-control input-lg" />
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">Phone</label>
            <div class="col-md-8">
                <input type="text" name="phone" value="{{ $data->phone }}" class="form-control input-lg" />
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">Email</label>
            <div class="col-md-8">
                <input type="text" name="email" value="{{ $data->email }}" class="form-control input-lg" />
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="form-group text-right">
            <input type="submit" name="edit" class="btn btn-primary input-lg" value="Submit" />
        </div>
    </form>

@endsection
