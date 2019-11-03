@extends('adminlte::page')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<h1>Product list:</h1>
<a href="/admin/books/create-book" class="btn btn-primary">Create</a>
<hr>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Book image</th>
            <th>Book title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Publisher</th>
            <th>Publish date</th>
            <th>Language</th>
            <th>Price(VNĐ)</th>
            <th>Created by</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr v-pre>
                <td> {{$book->id}} </td>
                <td><img src="{{ url($book->image) }}" alt="{{$book->image}}" style="width: 120px; height: 189.5px;"></td>
                <td> {{$book->title}} </td>
                <td> {{$book->author}} </td>
                @foreach ($book->categories as $category)
                    <td style="text-align: center">
                    <strong>{{ $category->parent->name ?? '' }}</strong>
                    <div>|</div>
                    <div>{{$category->name ?? ''}}</div>
                    </td>
                @endforeach
                <td> {{$book->publisher}} </td>
                <td> {{$book->publish_date}} </td>
                <td> {{$book->language}} </td>
                <td class="currency-data">{{$book->price}}</td>
                <td>{{$book->user ? $book->user->email : ''}}</td>
                <td>
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Book image</th>
            <th>Book title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Publisher</th>
            <th>Publish date</th>
            <th>Language</th>
            <th>Price(VNĐ)</th>
            <th>Created by</th>
            <th></th>
        </tr>
    </tfoot>
</table>

@endsection

@section('css')
@stop

@section('js')
@stop