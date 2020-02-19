@extends('layouts.app')
<?php
//get the total number of products in each categories
$catagory1=DB::table('products')->where('product_catagory','=',1)->count();

if($catagory1==null){
    $catagory1=0;
}
//---------------------------------------
$catagory2=DB::table('products')->where('product_catagory','=',2)->count();

if($catagory2==null){
    $catagory2=0;
}
//----------------------------------------------------
$catagory3=DB::table('products')->where('product_catagory','=',3)->count();

if($catagory3==null){
    $catagory3=0;
}
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            [' Home Accessories',<?php echo $catagory1;?>],
            ['Electronics',<?php echo $catagory2;?>],
            ['Others',<?php echo $catagory3;?>]
            
        
        ]);

        var options = {
            title: 'Product Category Statistics',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>


`<?php
//get the total number of active and banned users
$active=DB::table('users')->where('status','=',1)->count();

if($active==null){
    $active=0;
}
//---------------------------------------
$banned=DB::table('users')->where('status','=',0)->count();

if($banned==null){
    $banned=0;
}

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            [' Active Users',<?php echo $active;?>],
            ['Banned Users',<?php echo $banned;?>]       
        ]);

        var options = {
            title: 'User Statistics',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
    }
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                        <div id="donutchart" style="width: 900px; height: 500px;"></div>
				 <div id="donutchart2" style="width: 900px; height: 500px;"></div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
