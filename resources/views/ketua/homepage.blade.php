@extends('layouts.starter')

@section('title', 'Halaman Utama ')

@section('link')


@endsection

@section('content')

		 <div class="row">
        <!-- ./col -->
        
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$jumlahPendingKelulusanDato}}</h3>

              <p>Permohonan dalam proses</p>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="{{route('semakkanDato')}}" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$TotalBerjaya1}}</h3>

              <p>Permohonan Berjaya</p>
            </div>
            <div class="icon">
              <i class="fa  fa-check-square-o"></i>
            </div>
            <a href="{{route('senaraiRekodIndividu')}}" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>    
          </div>
        </div>
         <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$TotalGagal1}}</h3>

              <p>Permohonan Gagal</p>
            </div>
            <div class="icon">
              <i class="fa fa-remove"></i>
            </div>
            <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        
       
      </div>

      <div class="row">
        <div class="col-md-12"> 
          <div class="row">
          <div class="col col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">PERMOHONAN KE LUAR NEGARA</h3>    

                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      
                  </div>
              </div>
            
              <div class="box-body">
                <div class="row"> 
                <div class="col-md-12">
                   <div class="box-body">

                    <div class="box box-success">
                      <div class="box-header with-border">
                        <h3 class="box-title"><strong>Rasmi</strong></h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="chart">
                          <canvas id="barChart" style="height:230px"></canvas>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>



                    <div class="box box-success">
                      <div class="box-header with-border">
                        <h3 class="box-title"><strong>Persendirian</strong></h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="chart">
                          <canvas id="barChart1" style="height:230px"></canvas>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  <!-- Custom Tabs -->
                
                  <!-- nav-tabs-custom -->
                </div>
              </div>
                
              </div>
             
              
          </div>
            
          </div>
        </div>
        </div>
        <!-- /.col -->
      </div>

		{{-- <a href="registerForm/{{ $userDetail -> id }}">Daftar Permohonan</a> --}}

      <!-- row -->
     {{--  --}}
      <!-- /.row -->


@endsection

@section('script')
<script>
 $(document).ready(function() {    

    //DOM manipulation code
//-------------
    //- BAR CHART -
    //-------------  

    var areaChartData = { 
      labels  : {!! json_encode($listnegara) !!},
      datasets: [
        {
          label               : 'Negara',
          fillColor           : 'rgba(111, 0, 196)', //tukar color
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#00a65a',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : {!! json_encode($listcount) !!} 
        }
      ]
    }


    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets.fillColor   = '#00a65a'
    barChartData.datasets.strokeColor = '#00a65a'
    barChartData.datasets.pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)

});
  
    
</script>

<script>
 $(document).ready(function() {    

    //DOM manipulation code
//-------------
    //- BAR CHART -
    //-------------  

    var areaChartData1 = { 
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Negara',
          fillColor           : 'rgba(84, 7, 250)', //tukar color
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#00a65a',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        }
      ]
    }


    var barChartCanvas1                   = $('#barChart1').get(0).getContext('2d')
    var barChart1                         = new Chart(barChartCanvas1)
    var barChartData1                     = areaChartData1
    barChartData1.datasets.fillColor   = '#00a65a'
    barChartData1.datasets.strokeColor = '#00a65a'
    barChartData1.datasets.pointColor  = '#00a65a'
    var barChartOptions1                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions1.datasetFill = false
    barChart1.Bar(barChartData1, barChartOptions1)

});
  
    
</script>

@endsection