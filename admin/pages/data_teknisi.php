<?php require_once('config/main.php'); 
$query=mysql_query("select * from admin");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Teknisi ( Terdapat <?php echo mysql_num_rows($query); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php if (isset($_SESSION['username'])): ?>
     <a href="tambah.php?tambah=data_teknisi" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data Teknisi</a>
 <?php endif; ?>
		<table class="table table-bordered" id="tabel">
		<thead>
			<tr>
		    <th>NO</th>
		    <th>USERNAME</th>
		    <th>NAMA</th>
		    <?php if (isset($_SESSION['username'])): ?>
		    <th>ACTION</th>
			<?php endif; ?>
		  </tr>
		</thead>
		<tbody>
			<?php
		  $no=1;
		  while($q=mysql_fetch_array($query)){
		  ?>
		  <tr>
		    <td><?php echo $no++; ?></td>  
		    <td><?php echo $q['username']?></td>        
		    <td><?php echo $q['nama']?></td>
		    <?php if (isset($_SESSION['username'])): ?>
		    <td>
		    	<a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q['id']; ?>">Edit</a>
		    	<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id=<?php echo $q['id']; ?>">Hapus</a>
		    </td>
			<?php endif; ?>
		  </tr>
		  <?php
		  }
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