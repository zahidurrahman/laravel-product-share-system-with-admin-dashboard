@include('include.header');
<?php
$id=$_GET['id'];
$flights = DB::table('orders')
    ->where('o_id',$id)
    ->first();
?>

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">

                    <!-- Review Form -->
                    <div class="col-md-6">
                        <div id="review-form">
                            <form class="review-form" method="POST" action="{{ route('rate_to_owner') }}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$id}}">
                                <input type="hidden" name="to_user_id" value="{{$flights->owner_id}}">
                                <textarea class="input" placeholder="Your Review" name="rate_details" required></textarea>
                                <div class="input-rating">
                                    <span>Your Rating: </span>
                                    <div class="stars">
                                        <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                        <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                        <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                        <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                        <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                    </div>
                                </div>
                                <button class="primary-btn">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Review Form -->

                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->


@include('include.footer');
