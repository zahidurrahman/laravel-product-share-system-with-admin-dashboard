@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/home"><button class="btn btn-warning"><i class="fa fa-arrow-left" ></i>&nbsp;Dashboard</button></a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <?php
                            $get_unit = DB::table('users')->where('id',Auth::id())->first();
                            ?>
                        <form method="POST" action="{{ route('edit_profile') }}">
                            @csrf

                            <div class="form-group" >
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"  value="{{$get_unit->name}}"required>
                            </div>

                            <div class="form-group" >
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{$get_unit->email}}" required readonly>
                            </div>

                            <div class="form-group" >
                                <label>Mobile No.</label>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                    <input  type="text" class="form-control @error('mobile') is-invalid @enderror" value="+60" readonly>
                                  </div>

                                  <div class="col-md-10">
                                     <input type="text" name="phone" value="{{$get_unit->phone}}" class="form-control" >
                                  </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control"id="autocomplete" name="eventlocation" onFocus="geolocate()" value="{{$get_unit->address}}"
                  							  required>
                            </div>
                            <div class="form-group row" style="display:none;">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">Lattitude</label>
                                   <div class="col-md-6">
                                    <input type="text" class="form-control" name="eventlat" id="latitude" value="{{$get_unit->lat}}"readonly required>
                                  </div>
                            </div>

                            <div class="form-group row" style="display:none;">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">Longitude</label>
                                   <div class="col-md-6">
                                  <input type="text" class="form-control" name="eventlong" id="longitude" value="{{$get_unit->long}}" readonly required>
                                   <div class="help-block with-errors"></div>
                                   </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input  id="password" type="text" name="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
     var placeSearch, autocomplete;
        var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
        };
        function initAutocomplete() {
          // Create the autocomplete object, restricting the search to geographical
          // location types.
          autocomplete = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
              {types: ['geocode']});
          // When the user selects an address from the dropdown, populate the address
          // fields in the form.
          autocomplete.addListener('place_changed', fillInAddress);
        }
         function fillInAddress() {
          // Get the place details from the autocomplete object.
          var place = autocomplete.getPlace();
          var lat = place.geometry.location.lat();
          var lng = place.geometry.location.lng();
          var componentForm = {
          locality: 'short_name',
        };
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            //document.getElementById("city").value = val;// for city shoet name
          }
        }

        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;

        }
    </script>

    <!-- auto complete api for location  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPm8t3q1VcSQ8B8_gZyi4nrVi7RC9TWC8&libraries=places&callback=initAutocomplete"
          async defer></script>
@endsection
