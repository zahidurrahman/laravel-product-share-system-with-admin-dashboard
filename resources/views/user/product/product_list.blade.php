@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/home"><i class="fas fa-arrow-left" style="margin-right: 10px"></i>Dashboard</a>
                        @foreach ($errors->all() as $error)
                            <li style="float:right;color:red;">{{ $error }}</li>
                        @endforeach
                    </div>

                    <div class="card-body">
                      @if (session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  {{ session('success') }}
                              </div>
                          @endif
                        <!-- Button trigger modal -->
                            <button type="button" style="margin-bottom: 10px;float:right" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                               <i class="fas fa-plus"></i>&nbsp;Add New Product
                            </button>
                            <?php
                            $Id = Auth::id();
                            if(Auth::user()->role=='1'){//for admin
                              $flights = DB::table('products')->get();
                            }else{
                                $flights = DB::table('products')->where('user_id',$Id)->get();
                            }

                            ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Product Cataogry</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Borrowing Duration</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;?>
                                  @foreach($flights as $share)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>
                                              @if($share->product_catagory=='1')
                                                  Home Accessories
                                              @endif
                                              @if($share->product_catagory=='2')
                                                  Electronies
                                              @endif
                                              @if($share->product_catagory=='3')
                                                  Others
                                              @endif

                                            </td>
                                            <td>{{$share->title}}</td>
                                            <td>{{$share->description}}</td>
                                            <td>{{$share->num_days}}</td>
                                            <td>
                                              @if($share->product_status=='1')
                                                  <button class="btn btn-success btn-sm">Active</button>
                                              @endif
                                              @if($share->product_status=='0')
                                                   <button class="btn btn-warning btn-sm">Inactive</button>
                                               @endif
                                            </td>

                                            <td>
                                              <a class="btn btn-primary btn-sm" href="{{'/product_edit/'.$share->id}}">Edit</a>
                                              @if($share->product_status=='1')
                                              <a class="btn btn-warning btn-sm" href="{{'/product/'.$share->id}}">Inactivate</a>
                                              @endif
                                              @if($share->product_status=='0')
                                              <a class="btn btn-success btn-sm" href="{{'/product/'.$share->id}}">Activate</a>
                                              @endif
                                             <a class="btn btn-danger btn-sm" href="{{'/product_del/'.$share->id}}">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++;?>
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
