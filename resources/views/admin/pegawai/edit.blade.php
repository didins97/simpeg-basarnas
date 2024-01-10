<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="pegawaiFormEdit" enctype="multipart/form-data">
            @csrf @method('PUT')
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
                            <a class="nav-item nav-link active" id="nav-infoE-tab" data-toggle="tab" href="#nav-infoE" role="tab" aria-controls="nav-infoE" aria-selected="true">Informasi Pribadi</a>
                            <a class="nav-item nav-link" id="nav-alamatE-tab" data-toggle="tab" href="#nav-alamatE" role="tab" aria-controls="nav-alamatE" aria-selected="false">Alamat</a>
                            <a class="nav-item nav-link" id="nav-pendidikanE-tab" data-toggle="tab" href="#nav-pendidikanE" role="tab" aria-controls="nav-pendidikanE" aria-selected="false">Pendidikan</a>
                            <a class="nav-item nav-link" id="nav-jabatanE-tab" data-toggle="tab" href="#nav-jabatanE" role="tab" aria-controls="nav-jabatanE" aria-selected="false">Jabatan</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-infoE" role="tabpanel"aria-labelledby="nav-infoE-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="namaLengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="namaLengkapEdit"
                                        placeholder="Masukkan Nama Lengkap" name="nama" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nip">NIP (Nomor Induk Pegawai) atau ID Pegawai</label>
                                    <input type="text" class="form-control" id="nipEdit"
                                        placeholder="Masukkan NIP atau ID Pegawai" name="nip">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jenisKelamin">Jenis Kelamin</label>
                                    <select id="jenisKelaminEdit" class="form-control" name="jns_kelamin" required>
                                        <option selected>Pilih...</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tempatTanggalLahir">Tempat dan Tanggal Lahir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tempatLahirEdit"
                                            placeholder="Tempat Lahir" name="t_lahir" required>
                                        <div class="input-group-append">
                                            <input type="date" class="form-control" id="tanggalLahirEdit" name="tgl_lahir" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control" id="agamaEdit" placeholder="Masukkan Agama" name="agama">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="statusPernikahan">Status Pernikahan</label>
                                    <select id="statusPernikahanEdit" class="form-control" name="status_maritai" required>
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
                        <div class="tab-pane fade" id="nav-alamatE" role="tabpanel" aria-labelledby="nav-alamatE-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="alamatEmail">Alamat Email</label>
                                    <input type="email" class="form-control" id="alamatEmailEdit"
                                        placeholder="Masukkan Alamat Email" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomorTelepon">Nomor WA</label>
                                    <input type="tel" class="form-control" id="nomorTeleponEdit"
                                        placeholder="Masukkan Nomor Telepon" name="nohp" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat <small style="color: red;">*</small></label>
                                <textarea class="form-control" rows="3" placeholder="Masukan Alamat" name="alamat" id="alamatRumahEdit"></textarea>
                              </div>
                        </div>
                        <div class="tab-pane fade" id="nav-jabatanE" role="tabpanel" aria-labelledby="nav-jabatanE-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatanEdit"
                                        placeholder="Masukkan Jabatan" name="jabatan" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="departemen">Departemen atau Unit Kerja</label>
                                    <input type="text" class="form-control" id="departemenEdit"
                                        placeholder="Masukkan Departemen atau Unit Kerja" name="unit_kerja" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggalMulaiBekerja">Tanggal Mulai Bekerja</label>
                                    <input type="date" class="form-control" id="tanggalMulaiBekerjaEdit" name="tanggal_masuk" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="statusPegawai">Status Pegawai</label>
                                    <select id="statusPegawaiEdit" class="form-control" name="status_pegawai" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fadde" id="nav-pendidikanE" role="tabpanel" aria-labelledby="nav-pendidikanE-tab">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="pendidikanTerakhir">Pendidikan Terakhir</label>
                                    <select id="pendidikanTerakhirEdit" class="form-control" name="pend_terakhir" required>
                                        <option selected disabled>Pilih Pendidikan Terakhir</option>
                                        <option value="SMA">SMA/SMK</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="S1">Sarjana (S1)</option>
                                        <option value="S2">Magister (S2)</option>
                                        <option value="S3">Doktor (S3)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="namaInstitusi">Nama Institusi Pendidikan</label>
                                    <input type="text" class="form-control" id="namaInstitusiEdit" placeholder="Masukkan Nama Institusi Pendidikan" name="nama_institut" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jurusanStudi">Jurusan Studi</label>
                                    <input type="text" class="form-control" id="jurusanStudiEdit" placeholder="Masukkan Jurusan Studi"  name="jurusan" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tahunLulus">Tahun Lulus</label>
                                    <input type="text" class="form-control" id="tahunLulusEdit" placeholder="Masukkan Tahun Lulus" name="tahun_lulus" required>
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
