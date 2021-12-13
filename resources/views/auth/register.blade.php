<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Ke Luar Negara: Daftar Pengguna</title>
    <link rel="icon" type="image/png" href="{{ asset('img/sukk.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/dist/css/adminlte.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte-3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logoKelantan.png') }}" alt="" height="30%" width="30%">
                <h3>SISTEM PERMOHONAN KE LUAR NEGARA</h3>
            </a>
        </div>
        <div class="card card-outline card-danger">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Daftar untuk mencipta akaun</p>

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama Pegawai" name="nama"
                            value="{{ old('nama') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" max="12" class="form-control" placeholder="No. Kad Pengenalan" name="nokp"
                            value="{{ old('nokp') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card-alt"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email"
                            value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="jantina" id="jantina" class="form-control select22" required>
                            <option value="">Pilih Jantina</option>
                            <option value="Lelaki">Lelaki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select id="jawatan" class="form-control select22" name="jawatan" required>
                            <option value="">Pilih Jawatan</option>
                            @foreach ($jawatan as $jaw)
                                <option value="{{ $jaw->idJawatan }}">{{ $jaw->namaJawatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <select id="gredKod" class="form-control select22" name="gredKod" required="required">
                                    <option value="">Pilih Kod Gred</option>
                                    @foreach ($gredKod as $gredKods)
                                        <option value="{{ $gredKods->gred_kod_ID }}">
                                            {{ $gredKods->gred_kod_abjad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="gredAngka" class="form-control select22" name="gredAngka"
                                    required="required">
                                    <option value="">Pilih Gred</option>
                                    @foreach ($gredAngka as $gredAngkas)
                                        <option value="{{ $gredAngkas->gred_angka_ID }}">
                                            {{ $gredAngkas->gred_angka_nombor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <select id="jabatan" class="form-control select22" name="jabatan" required>
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatan as $jab)
                                <option value="{{ $jab->jabatan_id }}">
                                    {{ $jab->nama_jabatan }}({{ $jab->kod_jabatan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required placeholder="kata Laluan">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required placeholder="Taip Semula Kata Laluan">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            {{-- <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div> --}}
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-danger btn-block">Daftar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="{{ url('login') }}" class="text-center">Saya telah mempunyai akaun.</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte-3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte-3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte-3/dist/js/adminlte.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte-3/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select22').select2({
            theme: 'bootstrap4'
        });

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    });
</script>

</html>
