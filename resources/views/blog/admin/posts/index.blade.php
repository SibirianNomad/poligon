@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row justify-container-center'>
            <div class='col-md-12'>
                <nav class='nav nav-toggleable-md navbar-light bg-faded'>
                    <a class='btn btn-primary' href="{{ route('blog.admin.posts.create') }}">Написать</a>
                </nav>
                <div class='card'>
                    <div class='card-body'>
                        <table class='table table-hover'>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Автор</th>
                                <th>Категории</th>
                                <th>Заголовки</th>
                                <th>Дата публикации</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                <tr @if(!$item->is_published) style="background-color:#ccc;"@endif>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->category->title}}</td>
                                    <td>
                                        <a href="{{ route('blog.admin.posts.edit', $item->id) }}">
                                            {{$item->title}}
                                        </a>
                                    </td>
                                    <td>{{$item->published_at}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($paginator->total() > $paginator->count())
        <div class='row justify-container-center'>
            <div class='col-md-12'>
                <div class='card'>
                    {{ $paginator->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection
