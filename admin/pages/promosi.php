<?php require_once('config/main.php');
$query=mysql_query("select * from promosi");
 ?>

 <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Promosi ( Terdapat <?php echo mysql_num_rows($query); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php if (isset($_SESSION['username'])): ?>
    <!-- <a href="tambah.php?tambah=promosi" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data Promosi </a> -->
    <a href="pages/cetakpromo.php" style="margin-bottom: 10px;" class="btn btn-md btn-danger"> <i class="fa fa-print"></i> Cetak PDF</a>
	<?php endif; ?>
		<table class="table table-bordered" id="tabel">
			<thead>
				<tr>
				<th>NO</th>
				<th>MEMBER</th>
				<th>JUDUL PROMOSI</th>
				<th>DETAIL PROMOSI</th>
				<th>FOTO</th>
				<th>TANGGAL PASANG</th>
				<!-- <th>TELEPON</th>
				<th>TANGGAL</th>
				<th>JAM</th> -->
				<?php if (isset($_SESSION['username'])): ?>
				<th>ACTION</th>
				<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				while($q=mysql_fetch_array($query)){
					$test = "select * from members where memberID = $q[update_by]";
				  // echo "$test";
				  $queryt=mysql_query($test);
				  while($e=mysql_fetch_array($queryt)){
				  $text = "<img src='http://si-mice.com/simice/files/pic/promosi/$q[promopic]' style='width: 100px; height: 100px;'>";
				?>
				<tr>
				<td><?php echo $no++; ?></td> 
				<td><?php echo $e['nama']?></td>     
				<td><?php echo $q['tittle']?></td>
				<td><?php echo $q['detail_promosi'] ?></td>
				<td><?php echo $text ?></td>
				<td><?php echo $q['date_update']?>, update by <?php echo $e['nama']?></td>
				    <!-- td><?php echo $q['telp']?></td>
				<td><?php echo $q['tgl']?></td>
				<td><?php echo $q['jam']?></td> -->
				<?php if (isset($_SESSION['username'])): ?>
				<td>
			    	<!-- <a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q['idpromosi']; ?>">Edit</a> -->
			    	<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id=<?php echo $q['idpromosi']; ?>">Hapus</a>
			    </td>
				<?php endif; ?>
				</tr>
				<?php
				}}
				?>
			</tbody>
		</table>
	</div>
</div>
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
 <script type="text/javascript">
	 $(document).ready(function() {
	 	$('#tabel').dataTable({
	          "bPaginate": true,
	          "bLengthChange": true,
	          "bFilter": true,
	          "bSort": true,
	          "bInfo": true,
	          "bAutoWidth": true
	    });
	 });
</script>