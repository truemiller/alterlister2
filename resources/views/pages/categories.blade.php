@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Categories</h1>
                <ul>
                    @foreach(\App\Models\Category::all()->where('parent', null)->sortBy('title') as $category)
                        <li>
                            <a href="{{route('cat', ["cat"=>$category->slug])}}" class="fw-bold">{{$category->title}}</a>
                            <ul>
                                @if($category->children())
                                    @foreach($category->children as $child)
                                        <li><a href="{{route('cat', ['cat'=>$child->slug])}}">{{$child->title}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
