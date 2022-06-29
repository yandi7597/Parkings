<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
</head>
<body>
<?php
$sql=mysqli_query($con, "select * from query_transaksi where id_transaksi='$_GET[id]'");
$data=mysqli_fetch_array($sql);
?>


    <table>
    <tr>
    <td><img src="parkiran.png" style="width:100px; height:100px;"></td>
    <td>
<center>

    <h2>Bukti Pembayaran Parkir</h2>
    <h3>PT. Astrada Makmur</h3>
    <h3>Jl. Taman kencana No.123 Kota Bandung</h3>
</center>
    </td>
    </tr>
</table>
<hr>
<table>
    <tr>
   <td>Kendaraan</td>
   <td>:</td>
   <td><?php echo $data['id_transaksi'] ?></td>
   </tr>
   <tr>
   <td>Plat No.</td>
   <td>:</td>
   <td><?php echo $data['platNo'] ?></td>
   </tr>
   <tr>
   <td>Tanggal Masuk</td>
   <td>:</td>
   <td><?php echo $data['tglMasuk'] ?></td>
   </tr>
   <tr>
   <td>Tanggal Keluar</td>
   <td>:</td>
   <td><?php echo $data['tglKeluar'] ?></td>
   </tr>
   <tr>
   <td>Jam Masuk</td>
   <td>:</td>
   <td><?php echo $data['jamMasuk'] ?></td>
   </tr>
   <tr>
   <td>Jam Keluar</td>
   <td>:</td>
   <td><?php echo $data['jamKeluar'] ?></td>
   </tr>
   <tr>
   <td>Tarif</td>
   <td>:</td>
   <td>Rp.<?php echo $data['tarif'] ?></td>
   </tr>
   <tr>
   <td>Lama Parkir</td>
   <td>:</td>
   <td><?php echo $data['lamaParkir'] ?> Jam</td>
   </tr>
   <tr>
   <td>Total</td>
   <td>:</td>
   <td>Rp.<?php echo $data['total'] ?></td>
   </tr>
    </table>
</body>
</html>