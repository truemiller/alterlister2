<footer class="bg-light border-top mt-auto shadow ">
    <div class="container mt-3">
        <div class="row py-3 mt-3">
            <div class="col-md-3">
                <strong>{{env('APP_NAME')}}</strong>
                <br>
                <em>We list similar software.</em>
                <p>&copy; <a href="//mlxn.ltd">MLXN</a> Ltd. 2022</p>
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
