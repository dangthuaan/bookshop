@extends('adminlte::page')

@section('content')

<div class="container">
    @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('Create category') }}</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="category_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Choose Category ') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id"
                                     autocomplete="parent_id" autofocus>
                                    <option value="0">{{ __('New Parent Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Category name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" required autocomplete="name">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection