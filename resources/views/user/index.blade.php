  @include('include.header');
<!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop01.png" alt="">
            </div>
            <div class="shop-body">

              <h3>Accessories<br>Collection</h3>
              <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop03.png" alt="">
            </div>
            <div class="shop-body">
              <h3>Electronics<br>Collection</h3>
              <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop02.png" alt="">
            </div>
            <div class="shop-body">
              <h3>Other<br>Collection</h3>
              <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
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
            <h3 class="title">New Products</h3>
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
                            Electronies
                        @endif
                        @if($share->product_catagory=='3')
                            Others
                        @endif
                      </p>
                      <h3 class="product-name"><a href="#">{{$share->title}}</a></h3>
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
