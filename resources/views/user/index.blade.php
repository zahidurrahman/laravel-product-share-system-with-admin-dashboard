  @include('include.header');
<!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="https://projectym.com/wp-content/uploads/2018/10/Sharing-Gifts-Feature.jpg" style="width:1200px;height:400px;" alt="Image">
        <div class="carousel-caption">
          <h3>Welcome to Let's Share</h3>
          <p>A website that allows users to share products for the people in the community.</p>
        </div>      
      </div>

      <div class="item">
        <img src="https://www.socialmediaimpact.com/wp-content/uploads/2018/01/share.jpg" style="width:1200px;height:400px;" alt="Image">
        <div class="carousel-caption">
          <h3></h3>
          <p></p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
      <!-- row -->
      <div class="row">
        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop011.png" alt="">
            </div>
            <div class="shop-body">

              <h3>Our<br>Services</h3>
              <a href="/services" class="cta-btn">View Services <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop012.png" alt="">
            </div>
            <div class="shop-body">
              <h3>About<br>Us</h3>
              <a href="/about" class="cta-btn">Get to know us <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop013.png" alt="">
            </div>
            <div class="shop-body">
              <h3>Contact<br>Us</h3>
              <a href="/contact" class="cta-btn">get in touch <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">

        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h3 class="title">Latest Products</h3>
            <!-- <div class="section-nav">
              <ul class="section-tab-nav tab-nav">
                <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
              </ul>
            </div> -->
          </div>
        </div>
        <!-- /section title -->

        <!-- Products tab & slick -->
        <div class="col-md-12">
          <div class="row">
            <div class="products-tabs">
              <!-- tab -->
              <div id="tab1" class="tab-pane active">
                <div class="products-slick" data-nav="#slick-nav-1">
                  <?php
                    $flights = DB::table('products')->where('product_status',1)->get();
                  ?>
                  <!-- product -->
                    @foreach($flights as $share)
                  <div class="product">
                      <a href="{{'/single?id='.$share->id}}">
                        <div class="product-img">
                        <img src="product_image/{{$share->cover_image}}" alt="">
                        <div class="product-label">
                          <span class="new">NEW</span>
                        </div>
                      </div>
                    </a>
                    <div class="product-body">
                      <p class="product-category">
                        @if($share->product_catagory=='1')
                            Home Accessories
                        @endif
                        @if($share->product_catagory=='2')
                            Electronics
                        @endif
                        @if($share->product_catagory=='3')
                            Others
                        @endif
                      </p>
                      <h3 class="product-name"><a href="{{'/single?id='.$share->id}}">{{$share->title}}</a></h3>
                      <h4 class="product-price">Share for {{$share->num_days}} Days</h4>
                      <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                      <div class="product-btns">
                          <button class="quick-view"><a href="{{'/single?id='.$share->id}}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></a></button>
                      </div>
                    </div>
                    <div class="add-to-cart">
                      <a href="{{'/single?id='.$share->id}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Book IT</button></a>
                    </div>
                  </div>
                  <!-- /product -->
                    @endforeach

                </div>
                <div id="slick-nav-1" class="products-slick-nav"></div>
              </div>
              <!-- /tab -->
            </div>
          </div>
        </div>
        <!-- Products tab & slick -->

      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

  @include('include.footer');
