<div class="card mt-3">
    <div class="card-body">
        <h2 id="reviews">Reviews</h2>
        <div itemscope itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating">
            <meta content="{{$entity->reviews->avg("stars") === 0 ? 5 : $entity->reviews->avg("stars")}}" itemprop="ratingValue">
            <meta content="{{$entity->reviews->count() === 0 ? 1 : $entity->reviews->count() }}" itemprop="reviewCount">
        </div>
{{--        <meta content="{{$entity->reviews->count() ?? 1 }}" itemprop="reviewCount">--}}
        <!-- Modal -->
        @if(Auth::check())
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Post a review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="/review_post">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" value="{{$entity->id}}" name="entity_id">
                                <label class="form-label" for="stars">Stars</label>
                                <select name="stars" id="" class="form-select">
                                    <option value="1">⭐</option>
                                    <option value="2">⭐⭐</option>
                                    <option value="3">⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                </select>
                                <label for="review" class="form-label">Review</label>
                                <textarea name="review" id="" cols="30" rows="10"
                                          class="form-control-plaintext border p-3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Post review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="{{Auth::check() ? "#reviewModal" : "#modalRegister"}}">
            Post a review
        </button>

        @if(!$entity->reviews->isEmpty())
            @foreach($entity->reviews as $review)
                <div class="card mt-3" itemprop="review" itemscope itemtype="https://schema.org/Review">
                    <div class="card-body">
                        @for($i=1;$i<=$review->stars; $i++) <i class="fa fa-star text-warning"></i>@endfor
                        <br>
                        <strong itemprop="author">{{$review?->user?->name ?? "Removed"}}</strong>
                        <meta itemprop="ratingValue" content="{{$review->stars}}">
                        <br>
                        <em>{{$entity->created_at}}</em>
                        <br>
                        <p itemprop="reviewBody">{{$review->review}}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p>There are no reviews at this time.</p>
        @endif
    </div>
</div>
