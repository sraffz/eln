<div class="card card-{{ $tema }}" id="borang_kenderaan_sendiri" style="display: none">
    <div class="card-header">
        <h3 class="card-title">BORANG MEMOHON UNTUK MENGGUNAKAN KENDERAAN SENDIRI</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="gaji"><i class="fa fa-money-check-alt"> </i> Gaji (RM)<span style="color:red;">*</span></label>
                    <input type="number" step="0.01"  class="form-control" id="gaji" name="gaji" value="{{ old('gaji') }}"
                        required>
                    <small><i></i></small>
                </div>
                <!-- text input -->
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label for="jenis_kenderaan"><i class="fas fa-car"></i> Jenis Kenderaan <span
                            style="color:red;">*</span></label>
                    <input type="type" class="form-control" name="jenis_kenderaan"
                        value="{{ old('jenis_kenderaan') }}" id="jenis_kenderaan" required>
                        <small><i>Jenama dan Model Kenderaan</i></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <!-- text input -->

                <div class="form-group">
                    <label for="no_kenderaan"><i class="fas fa-sign"></i> No. Kenderaan <span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="no_kenderaan" value="{{ old('no_kenderaan') }}"
                        id="no_kenderaan" required>
                        <small><i>Nombor pendaftaran kenderaan</i></small>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label for="kuasa_enjin"><i class="fas fa-car-side"></i> Kuasa Enjin <span
                            style="color:red;">*</span></label>
                    <input type="number" class="form-control" name="kuasa_enjin" value="{{ old('kuasa_enjin') }}"
                        id="kuasa_enjin" required>
                        <small><i>Contoh: 1000/1300/1500</i></small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="kelas_perbatuan"><i class="fas fa-layer-group"></i> Kelas Perbatuan <span
                            style="color:red;">*</span></label>
                    <input type="type" class="form-control" name="kelas_perbatuan"
                        value="{{ old('kelas_perbatuan') }}" id="kelas_perbatuan" required>
                </div>
            </div>
        </div>
    </div>

</div>
