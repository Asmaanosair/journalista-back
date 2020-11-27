@extends('admin.layouts.adminLayout')
@section('content')
<div class="content">
    <form method="post" action="{{route('rss.search')}}">
        @csrf
        <input type="text" name="url" placeholder="Enter website feed URL">&nbsp;<input type="submit" value="Submit" name="submit">
    </form>
    <h1></h1>
    @forelse($posts as $post)
    {{$post->enclosure}}
    <div class="post">
    <img src="{{$post->enclosure['url']}}"  style="width:100%; height:200px" alt="">
        <div class="post-head">
            <h2><a class="feed_title" href="{{$post->link}}"> {{$post->title}}</a></h2>
            <span> {{$post->pubDate}}</span>
        </div>
        <div class="post-content">
            <p>{{implode(' ', array_slice(explode(' ',  $post->description), 0, 20)) . "..."}}</p>
            <p>{{$post->link}} الاسم </p>
            <a href="{{$post->link}}">Read more</a>
        </div>
    </div>
    @empty
    <div class="alert alert-primary" role="alert">
        No News Yet
    </div>
    @endforelse
</div>
@stop
