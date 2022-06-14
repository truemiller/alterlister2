<div class="card mt-3">
    <div class="card-body">
        <h2 id="reviews">Reviews</h2>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Post a review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Post review</button>
                    </div>
                </div>
            </div>
        </div>


        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Post a review
        </button>

        @if(!$entity->reviews->isEmpty())
            @foreach($entity->reviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        {{$review->user->name}}
                        {{$review->review}}
                    </div>
                </div>
            @endforeach
        @else
            <p>There are no reviews at this time.</p>
        @endif
    </div>
</div>
