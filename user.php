<?php include "koneksi.php"; ?>
<form method="post">
<?php
if(isset($_POST['simpan'])){
	mysqli_query($con,"insert into tb_user(`nama`,`jk`,`username`,`password`,`status`)values('$_POST[nama]','$_POST[jk]','$_POST[username]','$_POST[password]','$_POST[status]')");
	echo "<script>alert('Data tersimpan');</script>";
}
if (isset($_GET['edit'])){
    $e=mysqli_query($con,"select * from tb_user where id_user = '$_GET[id]'");
    $dit=mysqli_fetch_array($e);
}
 

if (isset($_GET['hapus'])){
    mysqli_query($con,"delete from tb_user where id_user = '$_GET[id]'");
    echo "<script>alert('data terhapus')</script>";
    echo "<script>document.location.href='?user'</script>";
}


if (isset($_POST['update'])){
    mysqli_query($con,"update tb_user set nama='$_POST[nama]',jk='$_POST[jk]',username='$_POST[username]',password='$_POST[password]',status='$_POST[status]' where id_user='$_GET[id]'");
    echo "<script>alert('data terubah')</script>";
    echo "<script>document.location.href='?user'</script>";
}
?>
<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group">
                                    <div class>
                                    <input type="text" name="nama" class="form-control form-control-user" value="<?php echo @$dit['nama']?>"
                                            placeholder="Nama">
                                    </div>
                                    <br>
                                <div class>
                                <select name="jk" class="form-control form-control-user" >
                                <option value="Jenis kelamin"> Jenis Kelamin </option>
                                <?php
                                $jk=array("laki-laki","perempuan");
                                foreach($jk as $jk){
                                ?>
                                <option value="<?php echo $jk?>"><?php echo $jk ?></option>
                                <?php } ?>
                                </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" value="<?php echo @$dit['username']?>"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <div class>
                                        <input type="password" name="password" class="form-control form-control-user" value="<?php echo @$dit['password']?>"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                </div>
                                <div class>
                                <select name="status" class="form-control form-control-user" >
                                <option value="status"> Status </option>
                                <?php
                                $st=array("Aktif","Tidak Aktif");
                                foreach($st as $st){
                                ?>
                                <option value="<?php echo $st?>"><?php echo $st ?></option>
                                <?php } ?>
                                </select>
                                </div>
                                <br>
                                <?php
                                if (isset($_GET['edit'])){ ?>
                                <input type="submit" name="update" value="UPDATE"class="btn btn-primary btn-user btn-block">
                                <?php }else{?>
                                <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary btn-user btn-block">
                                <?php } ?>
                                <br>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
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
                        <th>Id User</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Id User</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
            if(isset($_POST['kirim'])){
              $sql=mysqli_query($con,"select * from tb_user where id_user like '%$_POST[pencarian]%' or nama like'%$_POST[pencarian]%' or username like '%$_POST[pencarian]%'");
             }else{
              $sql=mysqli_query($con,"select * from tb_user");
             }
                
             $no=0;
             while($data=mysqli_fetch_array($sql)){
             $no++;
           	?>
           <br>
           <tr>
           	<td><?php echo $no ?></td>
           	<td><?php echo $data['id_user']?></td>
            <td><?php echo $data['nama']?></td>
            <td><?php echo $data['jk']?></td>
           	<td><?php echo $data['username']?></td>
            <td><?php echo $data['password']?></td>
            <td><?php echo $data['status']?></td>
            
           	<td> <a href="?user&hapus&id=<?php echo $data['id_user']?>">Hapus</a>|
               <a href="?user&edit&id=<?php echo $data['id_user']?>">Edit</a></td>
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