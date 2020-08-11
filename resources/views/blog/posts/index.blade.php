@extends('layouts.app')

@section('content')
<table>
    @foreach($items as $post)
    <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->except}}</td>
    </tr>
    @endforeach
</table>
@endsection