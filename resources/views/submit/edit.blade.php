@extends("layouts.app")

@section("main")
    @if(Session::get("alert"))
    <div class="alert {{Session::get("alert-class")}}">
        {{Session::get("alert")}}
    </div>
    @endif
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h1>Edit</h1>
                <form action="{{route('entity.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$entity->slug}}" name="slug" required>
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="" class="form-select" required>
                        <option>-</option>
                        @foreach(\App\Models\Category::all()->sortBy("title") as $category)
                            <option value="{{$category->id}}" @if($entity->parent->id === $category->id)
                            selected
                                @endif
                            >{{$category->title}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="title" class="form-label">Title (Max 255 characters)</label>
                    <input type="text" class="form-control" name="title" required placeholder="Enter a title" value="{{$entity->title}}">
                    <br>
                    <label for="description" class="form-label">Description (Max 1000 characters)</label>
                    <textarea class="form-control" rows="10" name="description" required placeholder="Enter a description">{{$entity->description}}</textarea>
                    <br>
                    <label for="link_1" class="form-label">Link to homepage</label>
                    <input type="text" class="form-control" name="link_1" required placeholder="https://enter.a.link" value="{{$entity->link_1}}">
                    <br>
                    <label for="logo" class="form-label">Logo (Max Size 10MB)</label>
                    <input type="file" name="logo" class="form-control" >
                    <br>
                    <label for="logo" class="form-label">Platforms</label><br>
                    @foreach(\App\Models\Platform::all() as $platform)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="platform[]" value="{{$platform->id}}"
                            @if($entity->platforms->contains($platform))
                                    checked
                                @endif>
                            <label class="form-check-label" for="platform">{{$platform->title}}</label>
                        </div>
                    @endforeach
                    <br><br>
                    <label for="tags" class="form-label">Tags (comma seperated)</label>
                    <input type="text" class="form-control" name="tags" required value="@foreach($entity->tags as $tag){{$tag->tag}},@endforeach">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
@endsection
