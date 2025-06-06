@extends('layouts.adminDashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Categorie</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm mb-2" href="{{ route('categories.index') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('categories.update', $categorie->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" placeholder="Name" class="form-control"
                        value="{{ $categorie->name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group with-title mb-3">
                    <strong>Description:</strong>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i>
                    Submit</button>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
