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
                                @foreach(\App\Models\Category::all()->sortBy("title") as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            <label for="title" class="form-label">Title (Max 255 characters)</label>
                            <input type="text" class="form-control" name="title" required>
                            <br>
                            <label for="description" class="form-label">Description (Max 1000 characters)</label>
                            <textarea class="form-control" rows="10" name="description" required></textarea>
                            <br>
                            <label for="logo" class="form-label">Logo (Max Size 10MB)</label>
                            <input type="file" name="logo" class="form-control" required>
                            <br>
                            <label for="tags">Tags (comma seperated)</label>
                            <input type="text" class="form-control" name="tags">
                            <br>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
