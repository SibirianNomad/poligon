@extends('layouts.app')

@section('content')
    <form method='POST' action="{{ route('blog.admin.categories.update', $item->id ) }}">
        @method('PATCH')
        @csrf
        <div class='container'>
            <div class='row justify-container-center'>
                <div class='col-md-8'>
                    @include('blog.admin.category.includes.item_edit_main_col')
                </div>
                <div class='col-md-3'>
                    @include('blog.admin.category.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection