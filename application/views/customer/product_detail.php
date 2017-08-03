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
<style>
	
	.spinner {
  width: 80px;
}
.spinner input {
  text-align: right;
}
.input-group-btn-vertical {
  position: relative;
  white-space: nowrap;
  width: 1%;
  vertical-align: middle;
  display: table-cell;
}
.input-group-btn-vertical > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
  padding: 8px;
  margin-left: -1px;
  position: relative;
  border-radius: 0;
}
.input-group-btn-vertical > .btn:first-child {
  border-top-right-radius: 4px;
}
.input-group-btn-vertical > .btn:last-child {
  margin-top: -2px;
  border-bottom-right-radius: 4px;
}
.input-group-btn-vertical i{
  position: absolute;
  top: 0;
  left: 4px;
}
	
	</style>
</head>

<body>

    <!-- Navigation Top_Menu -->
    <?php $this->load->view('layout/navigation')?>
    <!-- Header Carousel -->

    <!-- Page Content -->
    <div class="container">

       <hr>
        <!-- /.row -->
        <div class="row">
                        <!-- body items -->
            <!-- load products from table -->
             <div class="col-md-4">
				<img width="400px" style="display:block;width:100%;max-width:400px" src="<?=base_url('/assets/uploads/'.$product->pro_image);?>">
			 </div>
			 <div class="col-md-8">

                <div class="panel panel-default">
					<div class="panel-heading">
							<h3><?=$product->pro_name.' - '.$product->pro_title;?> </h3> 
                    </div>
					
                    <div class="panel-body" width="100px">
						<div class="col-md-12" style="height:250px;">
							<h4>IDR <?=$product->pro_price?></h4>
							<p><?=$product->pro_description?></p>
						</div>  
						<div class="col-md-12">
							<div class="form-inline">
							<div class="form-group">
								<input type="hidden" id="cart_<?=$product->pro_id;?>" value="<?=$product->pro_id;?>">
								<!--
									<?=  anchor('home/add_to_cart/'.$product->pro_id,'Add To Cart || Buy',['class'=>'btn btn-success  btn-xs','role'=>'button']) ?>
								-->
								<button id="<?=$product->pro_id;?>" class="btn btn-cart btn-success form-control btn-xs">Add To Cart || Buy</button>
								</div>
								<div class="form-group">
								<div class="input-group spinner">
									<input type="hidden" id="qty_max_<?=$product->pro_id;?>" value="<?=$product->pro_stock;?>">
									<input type="text" class="form-control" id="qty_<?=$product->pro_id;?>" value="1">
									<div class="input-group-btn-vertical">
									  <button class="btn btn-default btn-caret-up" id="<?=$product->pro_id;?>" type="button"><i class="fa fa-caret-up"></i></button>
									  <button class="btn btn-default btn-caret-down" id="<?=$product->pro_id;?>" type="button"><i class="fa fa-caret-down"></i></button>
									</div>
								</div>
								</div>
							</div>
						</div>
                    </div>
					
					
					
                </div>
            </div>  
			
        </div>
        <!-- /.row -->

        <!-- Features Section -->

        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Report For Buggs</a>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php $this->load->view('layout/footer')?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url('/assets/js/jquery.js');?>"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
	
	$(".btn-cart").click(function(){
		var stock = $("#qty_max_"+this.id).val();
		if(parseInt($("#qty_"+this.id).val())>=stock){
			alert("Stock Tidak Tersedia (Tersedia: "+stock+"), Mohon Rubah Quantity");
			return false;
		}
	
		$.post("<?=base_url();?>home/add_to_cart/",{id:$("#cart_"+this.id).val(),qty:$("#qty_"+this.id).val(),stock:stock})
		.success(function(data){
			if(data==0){
				alert('Harap login terlebih dahulu');
				window.location.href='<?=base_url('login');?>';
			}else if(data==1){
				window.location.href='<?=base_url();?>';
			}
		})
	})
	
	$(".btn-caret-up").click(function(){
			var stock = $("#qty_max_"+this.id).val();
			var plus = parseInt($('#qty_'+this.id).val(), 10) + 1;
			if(plus<=stock){
				$('#qty_'+this.id).val(plus);
			}
		})
		
		$(".btn-caret-down").click(function(){
			if($('#qty_'+this.id).val()==1){
				  return false;
			}
			$('#qty_'+this.id).val( parseInt($('#qty_'+this.id).val(), 10) - 1);
		})
    </script>

</body>

</html>
