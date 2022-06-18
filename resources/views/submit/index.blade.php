@extends("layouts.app")

@section("main")
    <div class="alert {{Session::get("class")}}">
        {{Session::get("msg")}}
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                        <h1>Submit software</h1>
                        <form action="{{route('submit.post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="" class="form-select" required>
                                <option>-</option>
                                @foreach(\App\Models\Category::all()->sortBy("title") as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="title" class="form-label">Title (Max 255 characters)</label>
                            <input type="text" class="form-control" name="title" required placeholder="Enter a title">
                            <br>
                            <label for="description" class="form-label">Description (Max 1000 characters)</label>
                            <textarea class="form-control" rows="10" name="description" required placeholder="Enter a description"></textarea>
                            <br>
                            <label for="link_1" class="form-label">Link to homepage</label>
                            <input type="text" class="form-control" name="link_1" required placeholder="https://enter.a.link">
                            <br>
                            <label for="logo" class="form-label">Logo (Max Size 10MB)</label>
                            <input type="file" name="logo" class="form-control" required>
                            <br>
                            <label for="image_1" class="form-label">Screenshot (Max Size 10MB)</label>
                            <input type="file" name="image_1" class="form-control" required>
                            <br>
                            <label for="logo" class="form-label">Platforms</label><br>
                            @foreach(\App\Models\Platform::all() as $platform)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="platform[]" value="{{$platform->id}}">
                                    <label class="form-check-label" for="platform">{{$platform->title}}</label>
                                </div>
                            @endforeach
                            <br><br>
                            <label for="tags" class="form-label">Tags (comma seperated)</label>
                            <input type="text" class="form-control" name="tags" required>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
