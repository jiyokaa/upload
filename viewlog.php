<?php

session_start();
error_reporting(E_ALL);
require 'db/connect.php' ;
require 'function/security.php';

	include("include/view.inc.php");
	
	getHeader("View log","View log (Last 25 file's upload)");	
	getNav();
	
		
	if($results=$db->query("SELECT * FROM log ORDER BY `updateTime` DESC limit 0,25")){
	if($results->num_rows){
			while($row=$results->fetch_object()) {
			$records[]=$row;	
			}	
		}	$results->free();
	}
?>


<div class="container">
     <div class="row">
          
          <div class="col-sm-12">
		  <?php
						if(!count($records)){
							echo 'No records';
						} else {
					?>
				<table class="table table-striped table-hover table-condensed">
					<thead>
						<tr>
							<th>No.</th>
							<th>Username</th>
							<th>File Name</th>							
							<th>Path</th>
							<th>Expire</th>
							<th>Upload Time</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
						foreach($records as $r){
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo escape($r->username); ?></td>
							<td><?php echo escape($r->fileName); ?></td>
							
							<td><?php echo $r->path ; ?></td>
							<td><?php echo $r->expire ; ?></td>
							<td><?php echo $r->updateTime ; ?></td>
						<tr>
						<?php
							$i++;
							}//end foreach
						}//end else
						?>
					</tbody>
				
				</table>
		  
		  </div><!-- end col -->
          
     </div><!-- end row -->
</div><!-- end container -->



