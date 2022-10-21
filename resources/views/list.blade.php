@extends('layouts.app')

@section('main')
<div class="container mt-4">
    <section class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">

                    <h2 class="font-weight-bolder mb-3 d-block pb-2">Most viewed</h2>
                    <table class="table table-responsive table-responsive-lg">
                        @foreach($popular_entities as $alternative)
                            @include('includes.list-media-entity', ['alternative'=>$alternative])
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
