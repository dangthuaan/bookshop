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
                    <h1>{{ __('Edit category') }}</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.categories.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="category_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Choose Category ') }}</label>
                            <div class="col-md-6">
                                <select id="categories" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id"
                                     autocomplete="parent_id" autofocus>
                                    <option disabled selected>Choose Category name</option>
                                        @foreach ($categories as $category)
                                        @if ($category->parent_id == null)
                                            <option id="parent" value="0" style="font-weight:700;">{{$category->name}}</option>
                                        @else
                                            <option id="child" value="{{$category->parent_id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$category->name}}</option>
                                        @endif
                                        @endforeach
                                </select>
                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div id="category-type" style="font-weight: 700;"></div>
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Category name') }}</label>
                            <div class="col-md-6">
                                <input id="category-text" type="text" class="form-control" name="name"
                                    value="" required autocomplete="name">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="" class="btn btn-danger">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#categories').change(function(){
            var eventTypeId = $("#categories option:selected");
            var selectedText = $("#categories option:selected").text();
            var trimSelectedText = $.trim(selectedText);

            //$("#categories option:selected").html($( "#categories option:selected" ).html().replace(/&nbsp;/g, ""))

            if (eventTypeId.is('[id="parent"]') ) {
                $('#category-type').text('Parent Category');
            }
            else {
                $('#category-type').text('Child Category');
            }

            $('#category-text').val(trimSelectedText).trim();
;

        });
    });
</script>
@stop