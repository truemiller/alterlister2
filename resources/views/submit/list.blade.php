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
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($submissions as $submission)
                        <tr>
                            <td>{{$submission->id}}</td>
                            <td>{{$submission->slug}}</td>
                            <td>{{$submission->title}}</td>
                            <td>{{$submission->created_at}}</td>
                            <td>{{$submission->active ? "Yes" : "No"}}</td>
                            <td><a href="#">Edit</a></td>
                            <td>
                                <form action="/delete_entity">
                                    <a href="#">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
