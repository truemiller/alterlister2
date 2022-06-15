<footer class="bg-secondary border-top mt-auto shadow">
    <div class="container">
        <div class="row py-3 mt-3">
            <div class="col-md-3">
                <strong>{{env('APP_NAME')}}</strong>
                <em>We list alternatives to popular software.</em>
                <p>&copy; MLXN Ltd. 2022</p>
            </div>
            <div class="col-md-3">
                <strong>Social Media</strong>
                <ul>
                    <li><a href="https://twitter.com/alterlister">Twitter</a></li>
                    <li><a href="//youtube.com/c/alterlister">YouTube</a></li>
                </ul>

            </div>
            <div class="col-md-3">
                <strong>Pages</strong>
                <ul>
                    <li><a href="{{route('about')}}">About</a></li>
                    <li><a href="{{route('terms')}}">Terms</a></li>
                    <li><a href="{{route('privacy')}}">Privacy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
