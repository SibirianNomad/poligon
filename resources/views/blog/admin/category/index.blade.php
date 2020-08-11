@extends('layouts.app')

@section('content')
   <div class='container'>
    <div class='row justify-container-center'>
        <div class='col-md-12'>
            <nav class='nav nav-toggleable-md navbar-light bg-faded'>
                <a class='btn btn-primary' href="{{ route('blog.admin.categories.create') }}">Добавить</a>
            </nav>
            <div class='card'>
                <div class='card-body'>
                    <table class='table table-hover'>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Категория</th>
                            <th>Родитель</th>
                        </td>
                        </thead>
                        <tbody>
                            @foreach($paginate as $item)
                                <tr>
                                 <td>{{$item->id}}</td>
                                 <td>
                                    <a href="{{ route('blog.admin.categories.create', $item->id) }}">
                                        {{$item->title}}
                                    </a>
                            
                                    <td @if(in_array($item->parent_id,[0,1])) style='color:#ccc;' @endif >
                                        {{$item->parent_id}}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   </div>
   <br>
   @if($paginate->total() > $paginate->count())
        <div class='row justify-container-center'>
            <div class='col-md-12'>
                <div class='card'>
                    {{ $paginate->links() }}
                </div>
            </div>
        </div>
   @endif
@endsection