<?php
// Proses Delete Data
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($koneksi,"DELETE FROM anggota WHERE id_anggota = '$id'");

    //Jika query delete berhasil maka munculkan notifikasi dan refresh halaman
    if ($query_delete) {
        ?>
        <div class="alert alert-success">
            Data Berhasil DIHAPUS !!!!!!!!!!
        </div>
        <?php
        header('Refresh:2; URL=http://localhost/04_mywebsite_12rpl2/admin.php?page=anggota');
    }
}
// end of proses delete

// Proses Insert Tambah Data
if(isset($_POST['simpan'])) {
    $nis        = $_POST['nis'];
    $nama       = $_POST['nama'];
    $kelas      = $_POST['kelas'];
    $jurusan    = $_POST['jurusan'];
    $tgl_lahir  = $_POST['tanggal_lahir'];
    $tlp        = $_POST['no_telp'];
    $alamat     = $_POST['alamat'];
    $jk         = $_POST['jenis_kelamin'];
    $query_insert = mysqli_query($koneksi,"INSERT INTO anggota VALUES('','$nis','$nama','$kelas','$jurusan','$tgl_lahir','$tlp','$alamat','$jk')");
    
// Membuat notifikasi jika berhasil/tidak disimpn datanya
    if($query_insert) 
    {
        ?>
            <div class="alert alert-success">
                Data Berhasil Disimpan !!!
            </div>
        <?php
        header('Refresh:2; URL=http://localhost/04_mywebsite_12rpl2/admin.php?page=anggota');
    }
    else
    {
        ?>
            <div class="alert alert-danger">
                Data GAGAL Disimpan !!!
            </div>
        <?php
    }

}
//
?>
<center><h4 class="mt-4 mb-3">Daftar Data Anggota</h4></center>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#input-data">
    Tambah Data
</button>
<!-- ------------------------------------------------------------------------------------- -->
<table class="table table-striped table-hover">
    <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Tgl Lahir</th>
        <th>Tlp</td>
        <th>Alamat</th>
        <th>Gender</th>
        <th>--Action--</th>
    </tr>
    <?php
        $query = mysqli_query($koneksi,"SELECT * FROM anggota");
        $no = 1;
        foreach ($query as $row) {
    ?>
    <tr>
        <td align="center" valign="middle"><?php echo $no; ?></td>
        <td valign="middle"><?php echo $row['nis']; ?></td>
        <td valign="middle"><?php echo $row['nama']; ?></td>
        <td valign="middle"><?php echo $row['kelas']; ?></td>
        <td valign="middle">
        <?php
            if ($row['jurusan']=='RPL') {
                echo "Rekayasa Perangkat Lunak";
            }elseif($row['jurusan']=='TAV'){
                echo "Teknik Audio Video";
            }elseif($row['jurusan']=='TKR'){
                echo "Teknik Kendaraan Ringan";
            }else{
                echo "Teknik Instalasi Tenaga Listrik";
            }
        ?>
            <?php echo $row['jurusan']; ?>
        </td>
        <td valign="middle"><?php echo $row['tanggal_lahir']; ?></td>
        <td valign="middle"><?php echo $row['no_telp']; ?></td>
        <td valign="middle"><?php echo $row['alamat']; ?></td>
        <td align="center" valign="middle">
            <?php echo $row['jenis_kelamin']; ?>
        </td>
        <td valign="middle">
        <a href="?page=anggota&delete&id=<?php echo $row['id_anggota']; ?>">
            <button class="btn btn-danger">Hapus</button>
        </a>
        <a  href="?page=anggota&edit&id=<?php echo $row['id_anggota']; ?>">
            <button class="btn btn-warning" >Edit</button>
        </a>
        </td>
    </tr>
    <?php
    $no++;
    }
    ?>
</table>
<!-- ------------------------------------------------------------------------- -->


<!-- Modal Input Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
<!-- Form Input Anggota -------------------------------------------------------- -->
            <form action="" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" name="nis" placeholder="NIS" required>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="nama" placeholder="Nama Siswa" required>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="kelas">
                        <option value="">--Pilih Kelas--</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jurusan">
                        <option value="">--Pilih Jurusan--</option>
                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                        <option value="TAV">Teknik Audio Video</option>
                        <option value="TKR">Teknik Kendaraan Ringan</option>
                        <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <div class="input-group">
                        <span class="input-group-text" >Tanggal Lahir</span>
                        <input class="form-control" type="date" name="tanggal_lahir">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="no_telp" placeholder="No Telepon">
                </div>
                <div class="form-group mt-2">
                    <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"></textarea>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jenis_kelamin">
                        <option value="">--Pilih Gender--</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
<!-- ---------------------------------------------------------------------------- -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success mt-2" type="submit" name="simpan">Simpan</button>
        </div>
<!-- tag tutup formnya pinda ke sini -->
            </form>
<!-- ------------------------------- -->
        </div>
    </div>
</div>
<!-- End of modal input data -->


<!-- Modal Edit Data -->
<!-- <?php
if (isset($_GET['edit'])) {
?> -->
<script>
	$(document).ready(function(){
		$("#edit-modal").modal('show');
	});
</script>
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- Form Edit Anggota -------------------------------------------------------- -->
            <form action="" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" name="nis" placeholder="NIS" required>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="nama" placeholder="Nama Siswa" required>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="kelas">
                        <option value="">--Pilih Kelas--</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jurusan">
                        <option value="">--Pilih Jurusan--</option>
                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                        <option value="TAV">Teknik Audio Video</option>
                        <option value="TKR">Teknik Kendaraan Ringan</option>
                        <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <div class="input-group">
                        <span class="input-group-text" >Tanggal Lahir</span>
                        <input class="form-control" type="date" name="tanggal_lahir">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="no_telp" placeholder="No Telepon">
                </div>
                <div class="form-group mt-2">
                    <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"></textarea>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jenis_kelamin">
                        <option value="">--Pilih Gender--</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
        <!-- ---------------------------------------------------------------------------- -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success mt-2" type="submit" name="simpan">Simpan</button>
        </div>
            <!-- tag tutup formnya pinda ke sini -->
            </form>
            <!-- ------------------------------- -->
        </div>
    </div>
</div>
<?php
}
?>