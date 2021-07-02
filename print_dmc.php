<?php 
require_once('sand_box.php');
page_header('Print DMC');
?>

</head>
<body>

<div class="container">
	
	<div class="text-center bg-warning">
         <h4>Print Single or Double DMC </h4>>
	</div>
	<?php require_once('nav.php');?>	
	<p class="text-danger"> Note: Two types of DMC can be printed, Single Student DMC(Use Left), or DMC of two students (Use Right)  </p>
	<div class="row">

		<div class="col-md-6">

 			<form class="" action="dmc_one.php" target="_blank" method="GET">
			    <div class="form-group">
			    	<p> Type Your Roll No To Print Single DMC  </p>
			    	<label for="name">Roll No:</label>
			    	<input type="number" class="form-control" id="rollno" name="rollno" placeholder="type Roll No" min="1" autofocus required>
			    	<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			    </div>
			</form>
		</div>
		<div class="col-md-6">
 			<form class="" action="dmc_double.php" target="_blank" method="GET">
			    <div class="form-group">
			    	<p> Type  Roll No  To Print Double DMC   </p>
			    	<label for="name">Roll No of First Student:</label>
			    	<input type="number" class="form-control" id="rollno" name="rollno" placeholder="type Roll No" min="1" autofocus required>
			    	
			    </div>
			    <div class="form-group">
			    	
			    	<label for="name">Roll No of Second Student:</label>
			    	<input type="number" class="form-control" id="rollno" name="rollno2" placeholder="type Roll No" min="1" autofocus required>
			    	<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			    </div>
			</form>
		</div>
	</div>
</div>






<?php

page_close();
?>


