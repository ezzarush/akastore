<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Online</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('/assets/css/modern-business.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('/assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- load for table and search in table -->
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/jquery-1.10.2.min.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/dataTables.bootstrap.js');?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/dataTables.bootstrap.css');?>">
</head>

	
	<body>
		
		<!-- Navigation -->
		<?php $this->load->view('layout/dash_navigation')?>
		<!-- Header- dash_menu -->
		<?php $this->load->view('layout/dash_menu')?>
		<!-- Page Content -->
		<div class="container">
			<!-- /.row -->
			<div class="table">
				<!-- body items -->
	
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><i class="fa fa-fw fa-user"></i> Category</h4>
							
						</div>
						<div class="panel-body">
							<table class="table table-striped table-hover" id="tableproducts">
								<div align="right" style="padding:10px;">
								<?=  anchor('admin/products/category_add/','Add Category',['class'=>'btn btn-primary ',
									'onclick'=>'return confirm(\'Are You Sure You Want Disabled This user ? \')'
								])  ?>
								</div>
								<thead>
									<tr>
										<th>No.</th>
										<th>ID Category</th>
										<th>Category Name</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php $x=1; foreach ($category as $cat ) : ?>
								<tr>
										<td><?=  $x;  ?></td>
										<td><?=  $cat['id_category'];  ?></td>
										
										<td><?=  $cat['category_name'];  ?></td>
										<td>
										<?=  anchor('admin/products/category_upd/'.$cat['id_category'],'Edit ',['class'=>'btn btn-success btn-xs ',
											'onclick'=>'return confirm(\'Are You Sure You Want Disabled This user ? \')'
										])  ?>
										<?=  anchor('admin/products/category_upd/'.$cat['id_category'],'Delete ',['class'=>'btn btn-warning btn-xs ',
											'onclick'=>'return confirm(\'Are You Sure You Want Disabled This user ? \')'
										])  ?>
								</td>
						<?php $x++; endforeach; ?>	
						</tbody>
							</table>
							<script>
								$(document).ready(function(){
									$('#tableproducts').DataTable();
									
								});
							</script>
						</div>
					</div>
				</div> 
				
			</div>
			<!-- /.row -->
			
			<!-- Features Section -->
			
			<!-- /.row -->
			
			
			<!-- Footer -->
			<?php $this->load->view('layout/footer')?>
			
		</div>
		<!-- /.container -->
		
		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		
		<!-- Script to Activate the Carousel -->
		
		
	</body>
	
</html>
