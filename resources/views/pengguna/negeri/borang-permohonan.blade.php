@extends('layouts.elnegeri.master')

@section('title', 'E-Luar Negeri | Borang')

@section('link')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>E-Luar Negeri | Borang Permohonan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('halamanUtamaNegeri') }}">E-Luar Negeri</a></li>
                        <li class="breadcrumb-item active">Borang Permohonan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('flash::message')
            <div class="row">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            @php
                // $url != url('senaraiRekodIndividu')
                if (Route::current()->getName() == 'borangLewat') {
                    $tema = 'danger';
                    $nilai = 1;
                    $lastDate = 0;
                } else {
                    $tema = 'teal';
                    $nilai = 0;
                    $lastDate = 0;
                }
            @endphp
            <form action="{{ route('negeri.hantar-permohonan') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- borang maklumat permohonan --}}
                <div class="card card-{{ $tema }}">
                    <div class="card-header">
                        <h3 class="card-title">Maklumat Program</h3> <input type="hidden" name="borang_lewat"
                            id="borang_lewat" value=" ">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="program"><i class="fa fa-edit"> </i> Program <span
                                            style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="program" name="program"
                                        value="{{ old('program') }}" required>
                                    <small><i>Nama Mesyuarat/Bengkel/Kursus/Taklimat.</i></small>
                                </div>
                                <!-- text input -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->

                                <div class="form-group">
                                    <label for="tarikhMula"><i class="fas fa-calendar"></i> Tarikh Mula Program <span
                                            style="color:red;">*</span></label>
                                    <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}" name="tarikhMula"
                                        value="{{ old('tarikhMula') }}" onBlur="myFunction()" id="tarikhMula"
                                        min="{{ \Carbon\Carbon::now()->addDays($lastDate)->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="tarikhAkhir"><i class="fas fa-calendar"></i> Tarikh Akhir Program <span
                                            style="color:red;">*</span></label>
                                    <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}"
                                        name="tarikhAkhir" value="{{ old('tarikhAkhir') }}" id="tarikhAkhir" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="phone"><i class="fa fa-phone"> </i> No. Telefon <span
                                            style="color:red;">*</span></label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        value="{{ old('phone') }}" data-inputmask='"mask": "999-99999999"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="tempat_program"><i class="fas fa-map-marker-alt"></i> Tempat Program <span
                                            style="color:red;">*</span></label>
                                    <input type="text" id="tempat_program" name="tempat_program" class="form-control"
                                        value="{{ old('tempat_program') }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <label for="negeri"><i class="fas fa-flag"></i> Negeri </label>
                                    <select class="form-control select2bs4" id="negeri" name="negeri"
                                        style="width: 100%;" required>
                                        <option value="">SILA PILIH</option>
                                        @foreach ($negeri as $state)
                                            <option value="{{ $state->negeri }}"
                                                {{ $state->negeri == old('negeri') ? 'selected' : '' }}>
                                                {{ $state->negeri }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <div class="icheck-primary  ">
                                        <input class="icheck-primary" OnChange="javascript:enableTextBox();"
                                            type="checkbox" value="1" name="negeri_lebih" id="negeri_lebih"
                                            @checked(old('negeri_lebih') == '1')>
                                        <label class="form-check-label" for="negeri_lebih">
                                            <strong> Adakah melawati lebih daripada 1 negeri?</strong>
                                        </label>
                                    </div>
                                    <select class="form-control select2bs4" name="negeri_tambahan[]" id="negeri_tambahan"
                                        style="width: 100%;" {{ old('negeri_lebih') == 1 ? '' : 'disabled' }} multiple>
                                        <option value="">SILA PILIH</option>
                                        @foreach ($negeri as $state)
                                            <option value="{{ $state->negeri }}"
                                                {{ $state->negeri == old('negeri') ? 'selected' : '' }}>
                                                {{ $state->negeri }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-1 mb-3">
                                <label for="exampleInputFile"><i class="fa fa-file"> </i> Surat
                                    Mesyuarat/Bengkel/Kursus/Taklimat <span style="color:red;">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="dokumen[]"
                                        id="exampleInputFile" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                    {{-- <small><i>*tertakluk kepada kelulusan dalaman bagi pejabat daerah atau perkara berkaitan.</i></small> --}}
                                    @if ($errors->has('dokumen'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dokumen') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="catatan_permohonan">Catatan</label>
                                    <textarea class="form-control" name="catatan_permohonan" id="catatan_permohonan" rows="3">{{ old('catatan_permohonan') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="catatan_permohonan">Sila Pilih Jenis Perjalanan <span
                                            style="color:red;">*</span> : - </label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input custom-control-input-teal" type="radio"
                                            id="customPejabat" name="jenisKenderaan" value="Kenderaan Pejabat" checked>
                                        <label for="customPejabat" class="custom-control-label">Kenderaan Pejabat</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input custom-control-input-teal" type="radio"
                                            id="customUdara" name="jenisKenderaan" value="Waran Udara">
                                        <label for="customUdara" class="custom-control-label">Waran Udara</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input custom-control-input-teal" type="radio"
                                            id="customSendiri" name="jenisKenderaan" value="Kenderaan Sendiri">
                                        <label for="customSendiri" class="custom-control-label">Kenderaan Sendiri</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                {{-- borang kenderaan sendiri --}}
                @include('pengguna.negeri.borang.kenderaan-sendiri')

                {{-- borang waran udara --}}
                @include('pengguna.negeri.borang.waran-udara')
                <div class="row mb-4">
                    <div class="col-sm-12 text-center">
                        <button type="reset" class="btn btn-danger"> Semula</button>
                        <button type="submit" class="btn btn-primary"> Hantar</button>
                        <br>
                        <br>
                    </div>
                </div>
            </form>
    </section>
@endsection

@section('script')
    <script type="text/javascript" language="javascript">
        function enableTextBox() {
            if (document.getElementById("negeri_lebih").checked == true)
                document.getElementById("negeri_tambahan").disabled = false;
            else
                document.getElementById("negeri_tambahan").disabled = true;
        }

        function myFunction() {
            var minToDate = document.getElementById("tarikhMula").value;
            document.getElementById("tarikhAkhir").setAttribute("min", minToDate);
            document.getElementById("tarikhAkhir").setAttribute("value", minToDate);
        }

        $('#customPejabat').on('change', function() {
            if (this.checked) {
                $("#borang_waran_udara").hide();
                $("#borang_kenderaan_sendiri").hide();

            }

        });
        $('#customSendiri').on('change', function() {
            if (this.checked) {
                $("#borang_kenderaan_sendiri").show();
                $("#borang_waran_udara").hide();
            }
            $("html, body").animate({
                scrollTop: 750
            }, 1800)
        });
        $('#customUdara').on('change', function() {
            if (this.checked) {
                $("#borang_waran_udara").show();
                $("#borang_kenderaan_sendiri").hide();
            }
            $("html, body").animate({
                scrollTop: 850
            }, 800)

        });
    </script>


@endsection
