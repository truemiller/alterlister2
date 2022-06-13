@extends('layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <h2>Edit</h2>
                <table class="table table-sm bg-white">
                    <thead>

                    <tr>
                        <th>Title</th>
                        <th>Views</th>
                    </tr>
                    </thead>
                    @foreach(\App\Models\Entity::all()->sortByDesc('id') as $entity)
                    <tr><td>{{$entity->title}}</td><td>{{$entity->getViews()}}</td><td><a href="{{}}" class="btn btn-sm btn-primary">Edit</a></td></tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-6">
                <h2>Create</h2>
                <form action="">
                    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Title</span></div><input class="form-control" type="text"></div>
                    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Slug</span></div><input class="form-control" type="text"></div>
                    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Short Desc</span></div><input class="form-control" type="text"></div>
                    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Long Desc</span></div><input class="form-control" type="text"></div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Logo</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Featured</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
