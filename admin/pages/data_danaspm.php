<?php require_once('config/main.php');
$query=mysql_query("select * from danaspm");
 ?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Dana SPM ( Terdapat <?php echo mysql_num_rows($query); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php if (isset($_SESSION['username'])): ?>
    <!-- <a href="tambah.php?tambah=data_danaspm" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data Dana SPM</a> -->
    <a href="pages/cetakdspm.php" style="margin-bottom: 10px;" class="btn btn-md btn-danger"> <i class="fa fa-print"></i> Cetak PDF</a>
	<?php endif; ?>
		<table width="100%" class="table table-bordered" id="tabel">
		<thead>
			
		  <tr>
		    <th>NO</th>
		    <th>MEMBER</th>
			<th>TANGGAL</th>
			<th>DETAIL KEGIATAN4</th>
		    <th>FOTO / FILE</th>
			<th>STATUS</th>
			<th>KETERANGAN</th>
			
			<?php if (isset($_SESSION['username'])): ?>
			<th>ACTION</th>
		    <?php endif; ?>
		  </tr>
		</thead>
		<tbody>
			<?php
		  $no=1;
		  while($q=mysql_fetch_array($query)){
		  $test = "select * from members where memberID = $q[create_by]";
		  // echo "$test";
		  $queryt=mysql_query($test);
		  while($e=mysql_fetch_array($queryt)){

		  $text = "";
		  $down = "";
		  if ($q['dspmpic'] != '') {
		  	# code...
		  	$text = "<img src='http://si-mice.com/simice/files/pic/danaspm/$q[dspmpic]' style='width: 100px; height: 100px;'>";
		  }
		  if ($q['dspmfile'] != '') {
		  	# code...
		  	$down = "<a href='http://si-mice.com/simice/files/doc/danaspm/$q[dspmfile]' style='margin-bottom: 10px;' class='btn btn-md btn-primary'> <i class='fa fa-file'></i> Download Proposal</a>";
		  }
		  
		  ?>
		  <tr>
		    <td><?php echo $no++; ?></td>  
		    <td><?php echo $e['nama']?></td>
			<td><?php echo $q['tanggal']?></td>
		    <td><?php echo $q['detail_dspm']?></td>
			<td><?php echo $text ?><br><?php echo $down ?></td>
			<td><?php echo $q['status'] ?></td>
			<td><?php echo $q['keterangan']?></td>
			<!-- <td><?php echo $q['update_by'] ?></td> -->
			
			
			
			<?php if (isset($_SESSION['username'])): ?>
			<td>
				<a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q['id_dspm']; ?>">Edit</a>
				<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id=<?php echo $q['id_dspm']; ?>">Hapus</a>
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