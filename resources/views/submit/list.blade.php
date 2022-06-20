@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h1>Submissions</h1>
                <table class="table table-sm table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Slug</th>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>Active</th>
                        <td>Views</td>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($submissions as $submission)
                        <tr>
                            <td>{{$submission->id}}</td>
                            <td><a href="{{route('ent',["ent"=>$submission->slug])}}">{{$submission->slug}}</a></td>
                            <td>{{$submission->title}}</td>
                            <td>{{$submission->created_at}}</td>
                            <td>{{$submission->active ? "Yes" : "No"}}</td>
                            <td>{{$submission->getViews()}}</td>
                            <td><a href="{{route('entity.edit', ["entity_id"=>$submission->id])}}">Edit</a></td>
                            <td>
                                <a href="{{route('entity.delete', ["entity_id"=>$submission->id])}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
