@extends("layouts.app")

@section('title')
    404: Not Found
@endsection

@section("main")
    <div class="container mt-3">
        <h1>404</h1>
        <p>Unfortunately, this page cannot be found.</p>
        <a href="/" class="btn btn-primary text-white">Find what you're looking for</a>
    </div>
@endsection
