
		<!-- Product Menu -->
		<div class="row">
            <div class="col-lg-12">
             <hr>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-th-large"></i> Choose Category : <i class="fa fa-arrow-circle-down"></i> </h4>
                    </div>
                    <div class="panel-body">
                        <!--
						<p> 
							<?php foreach ($starts as $start ) :?>
								<?=  anchor('home/showme/'.$start['id_category'],$start['category_name'],['class'=>'btn btn-default']) ?>
                            <?php endforeach; ?>
                        </p>
						-->
						
						<?php
							$CI =& get_instance();
							$data = $CI->db->query("SELECT *,COALESCE((SELECT id_subcategory FROM subcategory sc WHERE sc.id_category=c.id_category GROUP BY sc.id_category),0)ok FROM category c")->result_array();
							$data2 = $CI->db->query("SELECT * FROM subcategory")->result_array();
							foreach($data as $row){
								if($row['ok']==0){
								?>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span data-bind="label"><?=$row['category_name'];?></span></button>
									</div>
								<?php								
								}else{
								?>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span data-bind="label"><?=$row['category_name'];?></span>&nbsp;<span class="caret"></span>

										</button>
										<ul class="dropdown-menu" role="menu">
										
											<?php
											foreach($data2 as $row2){
												if($row2['id_category'] == $row['id_category']){
												?>
													<li><a href="<?=base_url('home/showme/');?><?='/'.$row2['id_subcategory'];?>"><?=$row2['subcategory'];?></a></li>
												<?php											
												}
											?>
											<?php
											}
											?>
										</ul>
									</div>
									
									
								<?php								
								}
							}
							?>	
						
                    </div>
                </div>
            </div> 
        </div>