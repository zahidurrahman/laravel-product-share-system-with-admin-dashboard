@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a href="/home"><button class="btn btn-warning"><i class="fa fa-arrow-left" ></i>&nbsp;Dashboard</button></a>
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
                        <form method="POST" action="{{ route('product_update') }}" enctype="multipart/form-data">
                            @csrf
                             <input type="hidden" name="product_id" value="{{ $userdata->id }}">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control"name="product_catagory" id="first" required>
                                  <option  selected value="{{$userdata->product_catagory}}">
                                    @if($userdata->product_catagory=='1')
                                        Home Accessories
                                    @endif
                                    @if($userdata->product_catagory=='2')
                                        Electronies
                                    @endif
                                    @if($userdata->product_catagory=='3')
                                        Others
                                    @endif
                                  </option>
                                    <option value="1">Home Accessories</option>
                                    <option value="2">Electronies</option>
                                    <option value="3">Others</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="product_title" class="form-control" id="exampleInputEmail1" value="{{ $userdata->title }}" aria-describedby="emailHelp"  required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="product_des" id="exampleFormControlTextarea1"  rows="3" required>{{ $userdata->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Borrowing Duration [Days]</label>
                                <input type="number" name="num_days" class="form-control" id="exampleInputEmail1" value="{{ $userdata->num_days }}" aria-describedby="emailHelp"  required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Cover Image [JPG/PNG]</label>
                                <input type="file" name="cover_image" class="form-control-file" id="exampleFormControlFile1" >


                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Other [JPG/PNG]</label>
                                <input type="file" name="other_image" class="form-control-file" id="exampleFormControlFile1" >
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
