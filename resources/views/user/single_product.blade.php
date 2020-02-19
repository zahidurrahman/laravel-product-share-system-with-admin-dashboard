@include('include.header');
    <?php
     $id=$_GET['id'];
      $share = DB::table('products')
			  ->join('users', 'products.user_id', '=', 'users.id')
			  ->select('users.*', 'products.*')
			  ->where('products.id',$id)
			  ->first();

       //for review
	    $get_rate = DB::table('ratings')
				->join('users', 'ratings.adder_id', '=', 'users.id')
				->select('users.*', 'ratings.*')
				->where('ratings.user_id',$share->user_id)
			    ->get();
	    $get_total_rate = DB::table('ratings')
						->where('user_id',$share->user_id )
						->avg('rate_value');
		$total_count = DB::table('ratings')
						->where('user_id',$share->user_id )
						->count();
         $value=round($get_total_rate,2);

		?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="product_image/{{$share->cover_image}}" alt="">
							</div>

							<div class="product-preview">
								<img src="other_image/{{$share->other_image}}" alt="">
							</div>

							<div class="product-preview">
								<img src="product_image/{{$share->cover_image}}" alt="">
							</div>

							<div class="product-preview">
								<img src="other_image/{{$share->other_image}}" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src="product_image/{{$share->cover_image}}" alt="">
							</div>

							<div class="product-preview">
								<img src="other_image/{{$share->other_image}}" alt="">
							</div>

							<div class="product-preview">
								<img src="product_image/{{$share->cover_image}}" alt="">
							</div>

							<div class="product-preview">
								<img src="other_image/{{$share->other_image}}" alt="">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{$share->title}}</h2>
							<div>
								<h3 class="product-price">Duration : {{$share->num_days}} Days</h3>
							</div>
							<p>
								 {{$share->description}}
							</p>
							<div class="add-to-cart">
								<form method="POST" action="{{ route('order') }}">
									@csrf
									<input type="hidden" name="product_id" value="{{$id}}">
									<input type="hidden" name="owner_id" value="{{$share->user_id}}">
									<input type="hidden" name="duration" value="{{$share->num_days}}">
								<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Book Now</button>
								</form>
							</div>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">
									@if($share->product_catagory=='1')
											Home Accessories
									@endif
									@if($share->product_catagory=='2')
											Electronics
									@endif
									@if($share->product_catagory=='3')
											Others
									@endif
								</a></li>

							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Owner Details</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews ({{$total_count}})</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>
 													{{$share->description}}
											</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-4">

											<h5 class="name">Name     : {{$share->name}}</h5>
											<h5 class="name">Email    : {{$share->email}}</h5>
											<h5 class="name">Phone    : {{$share->phone}}</h5>
											<h5 class="name">Address  :  {{$share->address}}</h5>
										</div>
										<div class="col-md-8">
											<style>
												/* Set the size of the div element that contains the map */
												#map {
													height: 400px;  /* The height is 400 pixels */
													width: 100%;  /* The width is the width of the web page */
												}
											</style>
											<a href="https://www.google.com/maps/search/?api=1&query={{$share->lat}},{{$share->long}}" target="_blank">
												<div id="map"></div>
											</a>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>{{$value}}</span>
													<div class="rating-stars">
														@if($value==1)
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
														@endif
														@if($value>1 && $value<2)
															<i class="fa fa-star"></i>
															<i class="fa fa-star-half-o"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
														@endif
														@if($value==2)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
														@endif
														@if($value>2 && $value<3)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-half-o"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
														@endif
														@if($value==3)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
														@endif
														@if($value>3 && $value<4)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-half-o"></i>
															<i class="fa fa-star-o empty"></i>
														@endif
														@if($value==4)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														@endif
														@if($value>4 && $value<5)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-half-o"></i>

														@endif
														@if($value==5)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														@endif
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 100%;"></div>
														</div>
														<span class="sum">5</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">4</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 40%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 20%;"></div>
														</div>
														<span class="sum">1</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													@foreach($get_rate as $rate)
													<li>
														<div class="review-heading">
															<h5 class="name">{{$rate->name}}</h5>
															<p class="date">{{$rate->created_at}}</p>
															<div class="review-rating">
																@if($rate->rate_value==1)
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star-o empty"></i>
																	<i class="fa fa-star-o empty"></i>
																	<i class="fa fa-star-o empty"></i>
																	<i class="fa fa-star-o empty"></i>
																@endif
																@if($rate->rate_value==2)
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star-o empty"></i>
																	<i class="fa fa-star-o empty"></i>
																	<i class="fa fa-star-o empty"></i>
																@endif
																@if($rate->rate_value==3)
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star-o empty"></i>
																	<i class="fa fa-star-o empty"></i>
																@endif
																@if($rate->rate_value==4)
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star-o empty"></i>
																@endif
																@if($rate->rate_value==5)
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																@endif
															</div>
														</div>
														<div class="review-body">
															<p>{{$rate->rate_details}}</p>
														</div>
													</li>
													@endforeach
												</ul>
												{{--<ul class="reviews-pagination">--}}
													{{--<li class="active">1</li>--}}
													{{--<li><a href="#">2</a></li>--}}
													{{--<li><a href="#">3</a></li>--}}
													{{--<li><a href="#">4</a></li>--}}
													{{--<li><a href="#"><i class="fa fa-angle-right"></i></a></li>--}}
												{{--</ul>--}}
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<!-- <form class="review-form">
													<input class="input" type="text" placeholder="Your Name">
													<input class="input" type="email" placeholder="Your Email">
													<textarea class="input" placeholder="Your Review"></textarea>
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
												</form> -->
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
<script type="text/javascript">

	var lati  = '<?php echo $share->lat;?>';
	console.log(lati);
	var longi  = '<?php echo $share->long;?>';
	console.log(longi);
	var lati=parseFloat(lati);
	var longi=parseFloat(longi);

	// Initialize and add the map
	function initMap() {
		// The location of Uluru
		var uluru = {lat: lati, lng: longi};
		// The map, centered at Uluru
		var map = new google.maps.Map(
				document.getElementById('map'), {zoom: 4, center: uluru});
		// The marker, positioned at Uluru
		var marker = new google.maps.Marker({position: uluru, map: map});
	}
</script>
<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->
<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPm8t3q1VcSQ8B8_gZyi4nrVi7RC9TWC8&callback=initMap">
</script>

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>
					<?php
						$flights = DB::table('products')
						->where('product_status',1)
						->where('product_catagory',$share->product_catagory)
						->get();
					?>
					<!-- product -->
						@foreach($flights as $share)
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<a href="{{'/single?id='.$share->id}}">
							<div class="product-img">
								<img src="product_image/{{$share->cover_image}}" alt="">
								<div class="product-label">

								</div>
							</div>
						</a>
							<div class="product-body">
								<p class="product-category">
									@if($share->product_catagory=='1')
	 									 Home Accessories
	 							 @endif
	 							 @if($share->product_catagory=='2')
	 									 Electronies
	 							 @endif
	 							 @if($share->product_catagory=='3')
	 									 Others
	 							 @endif

								</p>
								<h3 class="product-name">{{$share->title}}</h3>
								<h4 class="product-price">Share for {{$share->num_days}} Days</h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="quick-view"><a href="{{'/single?id='.$share->id}}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></a></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><a href="{{'/single?id='.$share->id}}"><i class="fa fa-shopping-cart"></i> Book Now</a></button>
							</div>
						</div>
					</div>
					<!-- /product -->
         @endforeach

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

@include('include.footer');
