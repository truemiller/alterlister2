@extends("layouts.app")
@section("main")
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">

                <table class="table table-striped table-sm">
                    <thead>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Link</th>
                    </thead>
                    @foreach(\App\Models\Entity::all()->sortBy("title") as $entity)
                        <tr>
                            <td>{{$entity->title}}</td>
                            <td>{{$entity->parent->title}}</td>
                            <td><a href="{{route('ent', ["ent"=>$entity->slug])}}#reviews">{{$entity->slug}}</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
