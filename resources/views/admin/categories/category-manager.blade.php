@extends('adminlte::page')

@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<h1>Category list:</h1>
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create</a>
<a href="{{ route('admin.categories.edit') }}" class="btn btn-info">Edit</a>
<hr>


<ul class="list-group">
    @foreach ($categories as $category)
            <li class="list-group-item {{ !isset($category->parent->name) ? 'active' : ''}}" style=" {{ isset($category->parent->name) ? 'margin-left: 30px' : ''}}"><i class="{{ !isset($category->parent->name) ? 'fas fa-th-list' : ''}}"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $category->name != null ? $category->name : $category->parent->name }}<i class="fas fa-trash operator"></i><i class="fas fa-edit operator"></i></li>
    @endforeach
</ul>
<!-- <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Category name</th>
            <th>Parent Category</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}} </td> //$category->parent->name ?? ''
                    <td>{{$category->name}}</td>
                    <td>{{$category->parent->name ?? ''}}</td>
                </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Category name</th>
            <th>Parent Category</th>
        </tr>
    </tfoot>
</table> -->
@endsection

@section('css')
<style>
.operator {
    float: right;
    padding: 0 15px;
}

.active {
    font-weight: 700;
}
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
@stop