@extends('layouts.app')

@section('main')
{{--    <div class="card shadow-sm mt-3 px-0">--}}
{{--                        <div class="card-body p-0">--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table table-hover table-condensed mb-0">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>#</th>--}}
{{--                                        <th>Logo</th>--}}
{{--                                        <th>Name</th>--}}
{{--                                        <th>Description</th>--}}
{{--                                        <th><i class="far fa-eye"></i></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($popular ?? '' as $entity)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$loop->index+1}}</td>--}}
{{--                                            <td class="align-top text-center"><img src="{{$entity->logo}}" alt="{{$entity->title}}" width="32"></td>--}}
{{--                                            <td><a href="{{route('ent', ['ent'=>$entity->slug])}}">{{$entity->title}}</a></td>--}}
{{--                                            <td>{{$entity->description}}</td>--}}
{{--                                            <td>{{$entity->getViews()}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

<div class="container mt-4">
    <section class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">

                    <h2 class="font-weight-bolder mb-3 d-block pb-2">Most viewed</h2>
                    <table class="table table-responsive table-responsive-lg">
                        @foreach($popular_entities as $alternative)
                            @include('includes.list-media-entity', ['alternative'=>$alternative])
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
