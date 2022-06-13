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
                            <label for="title">Title (Max 255 characters)</label>
                            <input type="text" class="form-control" name="title" required>
                            <br>
                            <label for="description">Description (Max 1000 characters)</label>
                            <textarea class="form-control" rows="10" name="description" required></textarea>
                            <br>
                            <label for="logo">Logo (Max Size 10MB)</label>
                            <input type="file" name="logo">
                            <br>
                            <label for="featured_image">Featured Image (Max Size 10MB)</label>
                            <input type="file" name="featured_image">
                            <br>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
