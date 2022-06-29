<?php include "koneksi.php"; ?>
<form method="post">
<?php
if(isset($_POST['simpan'])){
    mysqli_query($con,"insert into tb_transaksi(`platNo`,`tglMasuk`,`tglKeluar`,`jamMasuk`,`jamKeluar`,`id_jenis`,`tarif`,`lamaParkir`,`total`)
    values('$_POST[platNo]','$_POST[tglMasuk]','$_POST[tglKeluar]','$_POST[jamMasuk]','$_POST[jamKeluar]','$_POST[jenis]','$_POST[tarif]','$_POST[lamaParkir]','$_POST[total]')");
    echo "<script>alert('Data tersimpan');</script>";
    echo "<script>document.location.href='?transaksi'</script>";
}
if (isset($_GET['keluar'])){
    $e=mysqli_query($con,"select * from query_transaksi where id_transaksi = '$_GET[id]'");
    $dit=mysqli_fetch_array($e);
}
 

if (isset($_GET['hapus'])){
    mysqli_query($con,"delete from tb_transaksi where id_transaksi = '$_GET[id]'");
    echo "<script>alert('data terhapus')</script>";
    echo "<script>document.location.href='?transaksi'</script>";
}


if (isset($_POST['update'])){
    mysqli_query($con,"update tb_transaksi set platNo='$_POST[platNo]',tglMasuk='$_POST[tglMasuk]',tglKeluar='$_POST[tglKeluar]',jamMasuk='$_POST[jamMasuk]',jamKeluar='$_POST[jamKeluar]',
    id_jenis='$_POST[jenis]',tarif='$_POST[tarif]',lamaParkir='$_POST[lamaParkir]',total='$_POST[total]' where id_transaksi='$_GET[id]'");
    echo "<script>alert('data terubah')</script>";
    echo "<script>document.location.href='?transaksi'</script>";
}
?>


<div class="container">
<?php
error_reporting(0);
?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                </div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Transaksi</h1>
                            </div>
                            <form class="user" method="post">
                                <div class>
                                 <div class="form-group">
                                <input type="text" name="platNo" class="form-control form-control-user" 
                                value="<?php 
                                if(isset($_GET['keluar'])){
                                    echo @$dit['platNo'];
                                }else{
                                    echo @$_POST['platNo'];
                                }
                                ?>"
                                placeholder="Plat Nomor">
                                </div>
                                <div class>
                                <div class="form-group">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tglMasuk" class="form-control form-control-user" 
                                value="<?php 
                                if(isset($_GET['keluar'])){
                                    echo @$dit['tglMasuk'];
                                }else{
                                    echo @$_POST['tglMasuk'];
                                }
                                ?>"
                                placeholder="Tanggal Masuk">
                                </div>
                                </div>
                                <div class>
                                <div class="form-group">
                                <label class="form-label">Tanggal Keluar</label>
                                <input type="date" name="tglKeluar" class="form-control form-control-user" 
                                value="<?php 
                                if(isset($_GET['keluar'])){
                                    echo @$dit['tglKeluar'];
                                }else{
                                    echo @$_POST['tglKeluar'];
                                }
                                ?>"
                                placeholder="Tanggal Keluar">
                                </div>
                                </div>
                                <div class>
                                <div class="form-group">
                                <label class="form-label">Jam Masuk</label>
                                <input type="time" name="jamMasuk" class="form-control form-control-user"  
                                value="<?php 
                                if(isset($_GET['keluar'])){
                                    echo @$dit['jamMasuk'];
                                }else{
                                    echo @$_POST['jamMasuk'];
                                }
                                ?>"
                                placeholder="Jam Masuk">
                                </div>
                                </div>
                                <div class>
                                <div class="form-group">
                                <label class="form-label">Jam Keluar</label>
                                <input type="time" name="jamKeluar" class="form-control form-control-user"
                                value="<?php 
                               
                                
                                    echo $_POST['jamKeluar'];
                                
                                ?>"
                                placeholder="Jam Keluar">
                                </div>
                                </div>
                                <div class>
                                <div class="form-group">
                                <input type="submit" name="cari" class="btn btn-success" value="Cari">

                                </div>
                                </div>
                                <div class>
                                <select name="jenis" class="form-control" onchange="submit()" >
                                <option value="id_jenis">Jenis Kendaraan</option>
                                <?php
                                $jns = mysqli_query($con,"SELECT * FROM tb_tarif");
                                while($j=mysqli_fetch_array($jns)){
                                ?>
                                <option value="<?php echo @$j['id_jenis']?>"<?php if(@$j['id_jenis']==@$_POST['jenis']) {
                                    echo "selected ='selected'";
                                }elseif(@$j['id_jenis']==@$dit['id_jenis']){
                                    echo "selected='selected'";
                                }
                                    ?>><?php echo @$j['kendaraan'] ?></option>
                                <?php } ?>
                                </select>
                                <br>
                                </div>
                                <div class>
                                <div class="form-group">
                                <?php
                                $tar = mysqli_query($con,"SELECT * FROM tb_tarif where id_jenis='$_POST[jenis]'");
                                $rif=mysqli_fetch_array($tar);
                                ?>
                                <input type="text" name="tarif" class="form-control form-control-user" value="<?php 
                                if(isset($_POST['jenis'])){
                                    echo @$rif['tarif'];
                                }elseif(isset($_GET['keluar'])){
                                    echo @$dit['tarif'];
                                }else{
                                    echo "0";
                                }
                                 ?>"
                                            placeholder="Tarif">
                                </div>
                                </div>
                                <div class>
                                <div class="form-group">
                                <?php
                                 if(isset($_POST['cari'])){ 
                                 $waktu_awal        =strtotime($_POST['jamMasuk']);
                                 $waktu_akhir    =strtotime($_POST['jamKeluar']); // bisa juga waktu sekarang now()
                                 
                                 //menghitung selisih dengan hasil detik
                                 $diff    =$waktu_akhir - $waktu_awal;
                                 }
                                ?>
                                <input type="text" name="lamaParkir" class="form-control form-control-user"  
                                value="<?php echo round($diff / 3600) ?>"
                                placeholder="Lama Parkir">
                                </div>
                                </div>
                                <div class>
                                <div class="form-group">
                                <input type="text" name="total" class="form-control form-control-user"
                                value="<?php
                                if(isset($_POST['cari'])){
                                $total=$_POST['lamaParkir'] * $_POST['tarif'];
                                echo round($total); 
                                }                          
                                ?>"
                                placeholder="Total">
                                </div>
                                </div>
                                <br>
                                <?php
                        if (isset($_GET['keluar'])){ ?>
                        <input type="submit" name="update" value="UPDATE"class="btn btn-primary btn-user btn-block">
                        <?php }else{?>
                        <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-user btn-block">
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Id Transaksi</th>
                        <th>Plat No.</th>
                        <th>Tgl Masuk</th>
                        <th>Tgl Keluar</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Tarif</th>
                        <th>Lama Parkir</th>
                        <th>Total</th>
                        <th>Action</th>
                        <th>Cetak</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            if(isset($_POST['kirim'])){
              $sql=mysqli_query($con,"select * from query_transaksi where id_transaksi like '%$_POST[pencarian]%' or platNo like'%$_POST[pencarian]%'");
             }else{
              $sql=mysqli_query($con,"select * from query_transaksi");
             }
                
             $no=0;
             while($data=mysqli_fetch_array($sql)){
             $no++;
           	?>
           <br>
           <tr>
           	<td><?php echo $no ?></td>
           	<td><?php echo $data['kendaraan']?></td>
            <td><?php echo $data['platNo']?></td>
            <td><?php echo $data['tglMasuk']?></td>
            <td><?php echo $data['tglKeluar']?></td>
            <td><?php echo $data['jamMasuk']?></td>
            <td><?php echo $data['jamKeluar']?></td>
            <td><?php echo $data['tarif']?></td>
            <td><?php echo $data['lamaParkir']?></td>
            <td><?php echo $data['total']?></td>

           	<td> <a href="?transaksi&hapus&id=<?php echo $data['id_transaksi']?>">Hapus</a>
               <a href="?transaksi&keluar&id=<?php echo $data['id_transaksi']?>">Keluar</a></td>
            <td><a href="cetak.php?id=<?php echo $data['id_transaksi'] ?>" target="blank"><input type="button" name="cetak" value="Cetak" class="btn btn-success btn-user btn-block"></a></td>
           </tr>
           
       <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>