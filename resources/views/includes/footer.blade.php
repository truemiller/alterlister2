<footer class="bg-white border-top mt-3 shadow">
    <div class="container">
        <div class="row py-3 mt-3">
            <div class="col-md-8">
                <h3 class="">Categories</h3>
                @foreach(\App\Models\Category::all()->sortBy("title") as $category)
                    <a class="badge bg-light text-decoration-none" href="/category/{{$category->slug}}">{{$category->title}}</a>
                    @endforeach
            </div>
            <div class="col-md-4">
                <h3>Links</h3>
                <ul>
                    <li><a href="//gameslike.co">GamesLike</a></li>
                    <li><a href="//similar.software">SimilarSoftware</a></li>
                    <li><a href="//similar.best">SimilarBest</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">&copy; MLXN 2022. All rights reserved.</div>
        </div>
    </div>
</footer>
