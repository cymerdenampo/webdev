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
    <h3 align="center"><strong>Add New Contacts</strong></h3>

    <div align="right">
        <a href="{{ route('crud.index') }}" class="btn btn-default">Back</a>
    </div>

    <form method="post" action="{{ route('crud.store') }}" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label class="col-md-4 text-right">Name</label>
            <div class="col-md-8">
                <input type="text" name="first_name" class="form-control input-lg" />
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>

        <div class="form-group">
            <label class="col-md-4 text-right">Company</label>
            <div class="col-md-8">
                <input type="text" name="company" class="form-control input-lg" />
            </div>
        </div>
        <br>
        <br>
        <br>


        <div class="form-group">
            <label class="col-md-4 text-right">Phone</label>
            <div class="col-md-8">
                <input type="text" name="phone" class="form-control input-lg" />
            </div>
        </div>
        <br>
        <br>
        <br>

        <div class="form-group">
            <label class="col-md-4 text-right">Email</label>
            <div class="col-md-8">
                <input type="email" name="email" class="form-control input-lg" />
            </div>
        </div>
        <br>
        <br>
        <br>

        <div class="form-group text-right">
            <input type="submit" name="add" class="btn btn-primary input-lg" value="Submit" />
        </div>

    </form>
@endsection
