<?php include "koneksi.php"; ?>
<form method="post">
<?php
if(isset($_POST['simpan'])){
	mysqli_query($con,"insert into tb_tarif(`kendaraan`,`tarif`)values('$_POST[kendaraan]','$_POST[tarif]')");
	echo "<script>alert('Data tersimpan');</script>";
}
if (isset($_GET['edit'])){
    $e=mysqli_query($con,"select * from tb_tarif where id_tarif = '$_GET[id]'");
    $dit=mysqli_fetch_array($e);
}
 

if (isset($_GET['hapus'])){
    mysqli_query($con,"delete from tb_tarif where id_tarif = '$_GET[id]'");
    echo "<script>alert('data terhapus')</script>";
    echo "<script>document.location.href='?tarif'</script>";
}


if (isset($_POST['update'])){
    mysqli_query($con,"update tb_tarif set kendaraan='$_POST[kendaraan]',tarif='$_POST[tarif]' where id_tarif='$_GET[id]'");
    echo "<script>alert('data terubah')</script>";
    echo "<script>document.location.href='?tarif'</script>";
}
?>


<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tarif Parkir</h1>
                            </div>
                            <form class="user" method="post">
                            <div class>
                            <div class="form-group">
                                <input type="text" name="kendaraan" class="form-control form-control-user" value="<?php echo @$dit['kendaraan']?>"
                                            placeholder="Kendaraan">
                                </div>
                                </div>
                                <div class>
                                <div class="form-group">
                                <input type="text" name="tarif" class="form-control form-control-user" value="<?php echo @$dit['tarif']?>"
                                            placeholder="Tarif">
                                </div>
                                </div>
                                <?php
                        if (isset($_GET['edit'])){ ?>
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
                        <th>Id Tarif</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tarif</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Id Tarif</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tarif</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
            if(isset($_POST['kirim'])){
              $sql=mysqli_query($con,"select * from tb_tarif where id_tarif like '%$_POST[pencarian]%' or kendaraan like'%$_POST[pencarian]%' or tarif like '%$_POST[pencarian]%'");
             }else{
              $sql=mysqli_query($con,"select * from tb_tarif");
             }
                
             $no=0;
             while($data=mysqli_fetch_array($sql)){
             $no++;
           	?>
           <br>
           <tr>
           	<td><?php echo $no ?></td>
           	<td><?php echo $data['id_tarif']?></td>
            <td><?php echo $data['kendaraan']?></td>
            <td><?php echo $data['tarif']?></td>
           	<td> <a href="?tarif&hapus&id=<?php echo $data['id_tarif']?>">Hapus</a>|
               <a href="?tarif&edit&id=<?php echo $data['id_tarif']?>">Edit</a></td>
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