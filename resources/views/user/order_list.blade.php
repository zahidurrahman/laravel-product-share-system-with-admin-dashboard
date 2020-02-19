@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/home"><button class="btn btn-warning"><i class="fa fa-arrow-left" ></i>&nbsp;Dashboard</button></a>
                        @foreach ($errors->all() as $error)
                            <li style="float:right;color:red;">{{ $error }}</li>
                        @endforeach
                    </div>
					
					
						
					<div class="search_box" style="margin-top:10px">
					<center>
						<form action="" id="form2">
							<div>
								<input type="text" id="search">
								<input class="btn btn-warning" type="button" id="submit_form" onclick="checkInput()" value="Submit">
							</div>
						</form>
						</center>
					</div>

					<!--END SEARCH BOX -->
					<script>
						function checkInput() {
							var query = document.getElementById('search').value;
							window.find(query);
							return true;
						}
					</script>




                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('status') }}
                            </div>
                        @endif
                    <!-- Button trigger modal -->

                        <?php
                        $Id = Auth::id();
                        if(Auth::user()->role=='1'){//for admin
                          $flights = DB::table('orders')
                              ->join('products', 'orders.product_id', '=', 'products.id')
                              ->join('users', 'orders.owner_id', '=', 'users.id')
                              ->select('products.*', 'orders.*','users.*')
                              ->orderBy('orders.o_id', 'desc')
                              ->get();
                        }else{
                          $flights = DB::table('orders')
                              ->join('products', 'orders.product_id', '=', 'products.id')
                              ->join('users', 'orders.owner_id', '=', 'users.id')
                              ->select('products.*', 'orders.*','users.*')
                              ->where('buyer_id',$Id)
							   ->whereIn('status_order', [1, 2])
                              ->orderBy('orders.o_id', 'desc')
                              ->get();
                        }

                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                              <th scope="col">Order ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Shared By</th>
                                <!-- <th scope="col">Owner Address</th>
                                <th scope="col">Owner Phone</th> -->
                                <th scope="col">Borrowed Date</th>
                                <th scope="col">Expire Date</th>
                                <th scope="col">Remaining days</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($flights as $share)
                                <tr>
                                  <td>{{$share->o_id}}</td>
                                    <td>{{$share->title}}</td>
                                    <td>{{$share->name}}</td>
                                    <!-- <td>{{$share->address}}</td>
                                    <td>{{$share->phone}}</td> -->
                                    <td>{{$share->take_date}}</td>
                                    <td>{{$share->expire_date}}</td>
                                    <td>
                                        <?php
                                          $exp=strtotime($share->expire_date);
                                          $or=strtotime($share->take_date);
                                          $remain=round(($exp - $or) / (60 * 60 * 24));
                                          ?>
                                         {{$remain}}
                                    </td>
                                    <td>

                                        @if($share->status_order=='1')
                                            <a class="btn btn-warning btn-sm" href="{{'/buyer_mark_borrow?id='.$share->o_id}}">Return Product</a>
                                        @endif
                                            @if($share->status_order=='2')
                                            <a class="btn btn-success btn-sm" >Completed</a>
                                        @endif
										@if($share->status_order=='3')
                                            <a class="btn btn-warning btn-sm" >Waiting for Owner confirmation</a>
                                        @endif

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('add_product') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Catagory</label>
                                            <select class="form-control"name="product_catagory" id="first" required>
                                                <option disabled selected value="">--Select--</option>
                                                <option value="1">Home Accessories</option>
                                                <option value="2">Electronies</option>
                                                <option value="3">Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" name="product_des" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Borrowing Duration [Days]</label>
                                            <input type="number" name="num_days" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Cover Image</label>
                                            <input type="file" name="cover_image" class="form-control-file" id="exampleFormControlFile1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Other Image</label>
                                            <input type="file" name="other_image" class="form-control-file" id="exampleFormControlFile1" required>
                                        </div>


                                        <button type="submit" class="btn btn-success">Add</button>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
            </div>
        </div>
    </div>
@endsection
