@extends('layouts.eln')

@section('title', 'Halaman Utama ')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Utama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Halaman Utama</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $jumlahPendingKelulusanDato + $jumlahPendingrombo }}</h3>
                            <p>Permohonan dalam proses</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-spinner"></i>
                        </div>
                        <a href="{{ route('semakkanDato') }}" class="small-box-footer">Selanjut <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $TotalBerjaya1 }}</h3>
                            <p>Permohonan Berjaya</p>
                        </div>
                        <div class="icon">
                            <i class="fa  fa-check-square"></i>
                        </div>
                        <a href="{{ route('senaraiRekodIndividu') }}" class="small-box-footer">Selanjut <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $TotalGagal1 }}</h3>
                            <p>Permohonan Gagal</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-minus-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <section class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <h1>PERMOHONAN KE LUAR NEGARA</h1>
                                    </div>

                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
                    </div>
                    {{-- RASMI --}}
                    <div class="row">
                        <div class="col col-md-12">
                            <div class="card card-primary">
                                <div class="card-header with-border">
                                    <h3 class="card-title">RASMI</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>Bil</th>
                                                <th>Negara</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($bilrasmi as $bbb)
                                            <tr class="text-center">
                                                <td scope="row">{{ $i++ }}</td>
                                                <td class="text-center">{{ $bbb->negara }}</td>
                                                <td class="text-center">{{ $bbb->bil }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- PERSENDIRAN --}}
                    <div class="row">
                        <div class="col col-md-12">
                            <div class="card card-primary">
                                <div class="card-header with-border">
                                    <h3 class="card-title">PERSENDIRIAN</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>Bil</th>
                                                <th>Negara</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($bilxrasmi as $bbb)
                                            <tr class="text-center">
                                                <td scope="row">{{ $i++ }}</td>
                                                <td class="text-center">{{ $bbb->negara }}</td>
                                                <td class="text-center">{{ $bbb->bil }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
    </section>
@endsection

@section('script')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte-3/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('table.display').DataTable({
                "pageLength": 5,
             "lengthMenu": [5, 10, 30, 50],
                "language": {
                    "emptyTable": "Tiada data",
                    "lengthMenu": "_MENU_ Rekod setiap halaman",
                    "zeroRecords": "Tiada padanan rekod yang dijumpai.",
                    "info": "Paparan dari _START_ hingga _END_ dari _TOTAL_ rekod",
                    "infoEmpty": "Paparan 0 hingga 0 dari 0 rekod",
                    "infoFiltered": "(Ditapis dari jumlah _MAX_ rekod)",
                    "search": "Carian:",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelum",
                        "sNext": "Seterusnya",
                        "sLast": "Akhir"
                    }
                },
            });
        });

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            //DOM manipulation code
            //-------------
            //- BAR CHART -
            //-------------  

            var areaChartData = {
                labels: {!! json_encode($listnegara) !!},
                datasets: [{
                    label: 'Negara',
                    fillColor: 'rgba(111, 0, 196)', //tukar color
                    strokeColor: 'rgba(210, 214, 222, 1)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#00a65a',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: {!! json_encode($listcount) !!}
                }]
            }


            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChart = new Chart(barChartCanvas)
            var barChartData = areaChartData
            barChartData.datasets.fillColor = '#00a65a'
            barChartData.datasets.strokeColor = '#00a65a'
            barChartData.datasets.pointColor = '#00a65a'
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
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
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Negara',
                    fillColor: 'rgba(84, 7, 250)', //tukar color
                    strokeColor: 'rgba(210, 214, 222, 1)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#00a65a',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                }]
            }


            var barChartCanvas1 = $('#barChart1').get(0).getContext('2d')
            var barChart1 = new Chart(barChartCanvas1)
            var barChartData1 = areaChartData1
            barChartData1.datasets.fillColor = '#00a65a'
            barChartData1.datasets.strokeColor = '#00a65a'
            barChartData1.datasets.pointColor = '#00a65a'
            var barChartOptions1 = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            }

            barChartOptions1.datasetFill = false
            barChart1.Bar(barChartData1, barChartOptions1)

        });
    </script>

@endsection
