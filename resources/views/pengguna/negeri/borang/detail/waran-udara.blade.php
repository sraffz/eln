
@if ($detail->jenis_perjalanan == "Waran Udara")
     <div class="card card-{{ $tema }}" id="borang_waran_udara">
@else
     <div class="card card-{{ $tema }}" id="borang_waran_udara" style="display: none">
@endif
    <div class="card-header">
        <h3 class="card-title">Borang Permohonan Waran Perjalanan Udara (WPUA) (TIKET KAPAL TERBANG)</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="perjalanan_udara"><i class="fa fa-edit"> </i>Perjalanan <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="perjalanan_udara" name="perjalanan_udara" disabled
                        value="{{ old('perjalanan_udara') }}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="dari_pergi"><i class="fas fa-plane-departure"></i> Dari <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="dari_pergi" name="dari_pergi" disabled
                        value="{{ old('dari_pergi') }}">
                    <small><i>Tempat Penerbangan.</i></small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="ke_pergi"><i class="fas fa-plane-arrival"></i> Ke <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="ke_pergi" name="ke_pergi" disabled
                        value="{{ old('ke_pergi') }}">
                    <small><i>Tempat Mendarat.</i></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="tarikh_pergi"><i class="fas fa-calendar-alt"></i> </i> Tarikh <span
                            style="color:red;">*</span></label>
                    <input type="date" class="form-control" id="tarikh_pergi" name="tarikh_pergi" disabled
                        value="{{ old('tarikh_pergi') }}">
                    <small><i>Tarikh Penerbangan ke program.</i></small>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="masa_pergi"><i class="fas fa-clock"></i> Masa <span style="color:red;">*</span></label>
                    <input type="time" class="form-control" id="masa_pergi" name="masa_pergi" disabled
                        value="{{ old('masa_pergi') }}">
                    <small><i>Waktu Penerbangan ke program.</i></small>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="jenis_penerbangan_pergi"><i class="fas fa-digital-tachograph"> </i> Jenis Penerbangan
                        <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="jenis_penerbangan_pergi" disabled
                        name="jenis_penerbangan_pergi" value="{{ old('jenis_penerbangan_pergi') }}">
                    <small><i>Tarikh tiket penerbangan.</i></small>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="kelayakan_kelas_pergi"><i class="fas fa-layer-group"> </i> Kelas Kelayakan <span
                            style="color:red;">*</span></label>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="kelayakan_kelas_pergi" disabled
                            id="bisnesCheck" value="bisnes">
                        <label for="bisnesCheck" class="custom-control-label">Bisnes</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="kelayakan_kelas_pergi" disabled
                            id="ekonomiCheck" value="ekonomi">
                        <label for="ekonomiCheck" class="custom-control-label">Ekonomi</label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="perjalanan_udara_pulang"><i class="fa fa-edit"> </i>Perjalanan <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="perjalanan_udara_pulang" name="perjalanan_udara_pulang" disabled
                        value="{{ old('perjalanan_udara_pulang') }}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="dari_pulang"><i class="fas fa-plane-departure"></i> Dari <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="dari_pulang" name="dari_pulang" disabled
                        value="{{ old('dari_pulang') }}">
                    <small><i>Tempat Penerbangan.</i></small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="ke_pulang"><i class="fas fa-plane-arrival"></i> Ke <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="ke_pulang" name="ke_pulang" disabled
                        value="{{ old('ke_pulang') }}">
                    <small><i>Tempat Mendarat.</i></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="tarikh_pulang"><i class="fas fa-calendar-alt"></i> </i> Tarikh <span
                            style="color:red;">*</span></label>
                    <input type="date" class="form-control" id="tarikh_pulang" name="tarikh_pulang" disabled
                        value="{{ old('tarikh_pulang') }}">
                    <small><i>Tarikh Penerbangan ke program.</i></small>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="masa_pulang"><i class="fas fa-clock"></i> Masa <span
                            style="color:red;">*</span></label>
                    <input type="time" class="form-control" id="masa_pulang" name="masa_pulang" disabled
                        value="{{ old('masa_pulang') }}">
                    <small><i>Waktu Penerbangan ke program.</i></small>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="jenis_penerbangan_pulang"><i class="fas fa-digital-tachograph"> </i> Jenis Penerbangan
                        <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="jenis_penerbangan_pulang" disabled
                        name="jenis_penerbangan_pulang" value="{{ old('jenis_penerbangan_pulang') }}">
                    <small><i>Tarikh tiket penerbangan.</i></small>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="kelayakan_kelas_pulang"><i class="fas fa-layer-group"> </i> Kelas Kelayakan <span
                            style="color:red;">*</span></label>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="kelayakan_kelas_pulang" disabled
                            id="bisnesCheckReturn" value="bisnes">
                        <label for="bisnesCheckReturn" class="custom-control-label">Bisnes</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="kelayakan_kelas_pulang" disabled
                            id="ekonomiCheckReturn" value="ekonomi">
                        <label for="ekonomiCheckReturn" class="custom-control-label">Ekonomi</label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="kaedah_perolehan"><i class="fas fa-edit"></i> </i> Kaedah Perolehan <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="kaedah_perolehan" name="kaedah_perolehan" disabled
                        value="{{ old('kaedah_perolehan') }}">
                    {{-- <small><i>Tarikh Penerbangan ke program.</i></small> --}}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="dokumen"><i class="fas fa-file"></i> Dokumen <span
                            style="color:red;">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="dokumen_penerbangan[]" disabled
                                    id="docFlight" multiple>
                                <label class="custom-file-label" for="docFlight">Pilih Fail</label>
                                {{-- <small><i>*tertakluk kepada kelulusan dalaman bagi pejabat daerah atau perkara berkaitan.</i></small> --}}
                                @if ($errors->has('dokumen_penerbangan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dokumen_penerbangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                </div>
            </div>
        </div>

    </div>
</div>
