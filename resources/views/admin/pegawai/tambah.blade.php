<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.pegawai.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Informasi Pribadi</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Alamat</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-pendidikan"
                                role="tab" aria-controls="nav-pendidikan" aria-selected="false">Pendidikan</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false">Jabatan</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home"
                            role="tabpanel"aria-labelledby="nav-home-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="namaLengkap">Nama Lengkap<small style="color: red;">*</small></label>
                                    <input type="text" class="form-control" id="namaLengkap"
                                        placeholder="Masukkan Nama Lengkap" name="nama" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nip">NIP (Nomor Induk Pegawai) atau ID Pegawai<small style="color: red;">*</small></label>
                                    <input type="text" class="form-control" id="nip"
                                        placeholder="Masukkan NIP atau ID Pegawai" name="nip">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jenisKelamin">Jenis Kelamin<small style="color: red;">*</small></label>
                                    <select id="jenisKelamin" class="form-control" name="jns_kelamin" required>
                                        <option selected>Pilih...</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tempatTanggalLahir">Tempat dan Tanggal Lahir<small style="color: red;">*</small></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tempatLahir"
                                            placeholder="Tempat Lahir" name="t_lahir" required>
                                        <div class="input-group-append">
                                            <input type="date" class="form-control" id="tanggalLahir"
                                                name="tgl_lahir" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="agama">Agama<small style="color: red;">*</small></label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="statusPernikahan">Status Pernikahan<small style="color: red;">*</small></label>
                                    <select id="statusPernikahan" class="form-control" name="status_maritai"
                                        required>
                                        <option selected>Pilih...</option>
                                        <option value="belum_menikah">Belum Menikah</option>
                                        <option value="menikah">Menikah</option>
                                        <option value="janda_duda">Janda/Duda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Foto</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="alamatEmail">Alamat Email<small style="color: red;">*</small></label>
                                    <input type="email" class="form-control" id="alamatEmail"
                                        placeholder="Masukkan Alamat Email" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomorTelepon">Nomor WA<small style="color: red;">*</small></label>
                                    <input type="tel" class="form-control" id="nomorTelepon"
                                        placeholder="Masukkan Nomor Telepon" name="nohp" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat <small style="color: red;">*</small></label>
                                <textarea class="form-control" rows="3" placeholder="Masukan Alamat" name="alamat"></textarea>
                              </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                            aria-labelledby="nav-contact-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="jabatan">Jabatan<small style="color: red;">*</small></label>
                                    <input type="text" class="form-control" id="jabatan"
                                        placeholder="Masukkan Jabatan" name="jabatan" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="departemen">Departemen atau Unit Kerja<small style="color: red;">*</small></label>
                                    <input type="text" class="form-control" id="departemen"
                                        placeholder="Masukkan Departemen atau Unit Kerja" name="unit_kerja" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggalMulaiBekerja">Tanggal Mulai Bekerja<small style="color: red;">*</small></label>
                                    <input type="date" class="form-control" id="tanggalMulaiBekerja"
                                        name="tanggal_masuk" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="statusPegawai">Status Pegawai<small style="color: red;">*</small></label>
                                    <select id="statusPegawai" class="form-control" name="jenis_pegawai" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Kontrak">Kontrak</option>
                                        <option value="Magang">Magang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fadde" id="nav-pendidikan" role="tabpanel"
                            aria-labelledby="nav-pendidikan-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="pendidikanTerakhir">Pendidikan Terakhir<small style="color: red;">*</small></label>
                                    <select id="pendidikanTerakhir" class="form-control" name="pend_terakhir" required>
                                        <option value="SMA">SMA/SMK</option>
                                        <option value="Diploma 3">Diploma 3</option>
                                        <option value="Diploma 4">Diploma 4</option>
                                        <option value="S1">Sarjana (S1)</option>
                                        <option value="S2">Magister (S2)</option>
                                        <option value="S3">Doktor (S3)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="namaInstitusi">Nama Institusi Pendidikan<small style="color: red;">*</small></label>
                                    <input type="text" class="form-control" id="namaInstitusi"
                                        placeholder="Masukkan Nama Institusi Pendidikan" name="nama_institut"
                                        required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jurusanStudi">Jurusan Studi<small style="color: red;">*</small></label>
                                    <input type="text" class="form-control" id="jurusanStudi"
                                        placeholder="Masukkan Jurusan Studi" name="jurusan" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tahunLulus">Tahun Lulus<small style="color: red;">*</small></label>
                                    <input type="text" class="form-control" id="tahunLulus"
                                        placeholder="Masukkan Tahun Lulus" name="tahun_lulus" required>
                                </div>
                            </div>
                            <div id="dynamicForm">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="jurusanStudi">Jenis File</label>
                                        <select name="jenis_file[]" id="jnsFile" class="form-control">
                                            <option value="sertifikat">Sertifikat</option>
                                            <option value="ijazah">Ijazah</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control-file" id="file" name="file[]"
                                            required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="file">Judul File</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control rounded-0" name="judul_file[]">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-success btn-flat btn-multiple"><i class="fas fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
