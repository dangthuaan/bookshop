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
                    <h1>{{ __('Create book') }}</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row col-md-10">
                            <div class="imageupload panel panel-default" id="my-image-upload">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left">Upload Book Image</h3>
                                </div>
                                <div class="file-tab panel-body">
                                    <label class="btn btn-success btn-file">
                                        <span>Browse</span>
                                        <!-- The file is stored here. -->
                                        <input type="file" name="image" class="@error('image') is-invalid @enderror"
                                            required autocomplete="image">
                                    </label>
                                    <button type="button" class="btn btn-danger" style="margin-left: 15px;">Remove</button>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-md-4 col-form-label text-md-right">{{ __('Book title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

                            <div class="col-md-6">
                                <input id="author" type="text"
                                    class="form-control @error('author') is-invalid @enderror" name="author"
                                    value="{{ old('author') }}" required autocomplete="author" autofocus>

                                @error('author')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category"
                                class="col-md-4 col-form-label text-md-right">{{ __('Choose Category ') }}</label>
                            <div class="col-md-6">
                                <select id="categories" class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                                     autocomplete="category_id" autofocus>
                                    <option disabled selected>Choose Category name</option>
                                        @foreach ($categories as $category)
                                            @if ($category->parent_id == null)
                                                <option id="parent" value="0" style="font-weight:700;" disabled>{{$category->name}}</option>
                                            @else
                                                <option id="child" value="{{$category->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$category->name}}</option>
                                            @endif
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
                            <label for="publisher"
                                class="col-md-4 col-form-label text-md-right">{{ __('Publisher') }}</label>

                            <div class="col-md-6">
                                <input id="publisher" type="text"
                                    class="form-control @error('publisher') is-invalid @enderror" name="publisher"
                                    value="{{ old('publisher') }}" required autocomplete="publisher">

                                @error('publisher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="publish_date"
                                class="col-md-4 col-form-label text-md-right">{{ __('Publish date') }}</label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="publish_date"
                                    value="{{ old('publish_date') }}" required autocomplete="publish_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="language"
                                class="col-md-4 col-form-label text-md-right">{{ __('Language') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('language') is-invalid @enderror" name="language"
                                    required autocomplete="language" autofocus>
                                    <option value="English">English</option>
                                    <option value="Vietnamese">Vietnamese</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="publish_date"
                                class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="currency" type="text" class="form-control" name="price"
                                    value="{{ old('price') }}" placeholder="VNĐ" required autocomplete="price">
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