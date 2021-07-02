<?php
//$link=require_once('db_connection.php');

	function page_header($page_name){
		echo '<!DOCTYPE html>
					<html lang="en">
						<head>
			    			<title>' .$page_name.  '</title>
							<meta charset="utf-8">
							<meta name="viewport" content="width=device-width, initial-scale=1">
							<link rel="stylesheet" href="css/bootstrap.min.css">
							<link rel="stylesheet" href="css/custom.css">
						  	<script type="text/javascript" src="js/jquery3.6.js">  </script>
						  	<script type="text/javascript" src="js/bootstrap.bundle.js">  </script>
						  	<script type="text/javascript" src="js/bootstrap.bundle.min.js.map">  </script>
						  	<script type="text/javascript" src="js/custom.js">  </script>';
	}


	function page_close(){

		echo'</body>
			</html>';
	}


	function select_class(){

echo '
<div class="form-group col-md-6">
	<label for="class_exam">Select Class Name: </label>
              <select class="form-control" name="class_exam" required>
                <option value="">Select Class </option>
                <option value="5th">5th</option>
                <option value="6th A" >6th A</option>
                <option value="6th B">6th B</option>
                <option value="7th">7th </option>
                <option value="8th">8th</option>
                <option value="8th A">8th A</option>
                <option value="8th B">8th B</option>
              </select>
      </div>
';
	}

function select_school(){

echo '
	<div class="form-group col-md-6">
		<label for="school">Select School Name: </label>
              <select class="form-control" name="school" required>
                <option value="">Select School </option>
                <option value="GHSS Chitor">GHSS Chitor</option>
                <option value="GMS Marghazar">GMS Marghazar</option>
                <option value="GMS Spal Bandai">GMS Spal Bandai</option>
                <option value="GPS Kokrai" >GPS Kokrai</option>
                <option value="GPS Chitor">GPS Chitor</option>
              </select>
            </div>

    ';
}

#SELECT DISTINCT (Total_Marks) FROM position ORDER BY Total_Marks DESC LIMIT 1,1  start from 4rd and select


function calculate_position($link,$class,$school,$year){

	$class_name=$class;
	$school_name=$school;
	$exam_year=$year;

	$q="SELECT Roll_No from students_info where Class='$class_name' AND School='$school_name' AND Year='$exam_year'";
	$qr=mysqli_query($link,$q) or die('Error in Q 1'.mysqli_error($link));
	while($qra=mysqli_fetch_assoc($qr)){
		$q2="SELECT * FROM marks WHERE Roll_No=".$qra['Roll_No'];
		$qr2=mysqli_query($link,$q2) or die('Error in Q 2'. mysqli_query($link));
		while($qra2=mysqli_fetch_assoc($qr2)){
			$sum=0;
			$sum=$qra2['English_Marks'] + $qra2['Urdu_Marks'] +$qra2['Maths_Marks'] + $qra2['Science_Marks'];
			$roll_no=$qra2['Roll_No'];
		    $q3="INSERT INTO position (Roll_No, Total_Marks ) VALUES ('$roll_no', '$sum')";
			$qr3=mysqli_query($link,$q3) or die('Error in Q 3 '.mysqli_error($link));
			echo " Roll No: ". $qra2['Roll_No']  . " Completed <br>";
		}
	}
	if($qr){
		return 1;
	}
	else{
		return 0;
	}
}

function add_data_into_position($link){
	$count_row="SELECT COUNT(Total_Marks) as total_rows FROM position";
	$cqe=mysqli_query($link,$count_row) or die('Error Count Rows:'.mysqli_error($link));
	$cqa=mysqli_fetch_assoc($cqe);
	$total_entries=$cqa['total_rows'];
	for($i=0;$i<$total_entries;$i++){ 
		$q="SELECT DISTINCT Total_Marks,Roll_No FROM position ORDER BY Total_Marks DESC LIMIT $i,1";
		$qr=mysqli_query($link,$q) or die('Error Select Distint total'. mysqli_query($link));
		$qra=mysqli_fetch_assoc($qr);
		$j=$i+1;
		if($i==0){
			 $q="Update students_info set Class_Position='1st out of $total_entries' WHERE Roll_No=".$qra['Roll_No']; 
			mysqli_query($link,$q) or die('Error in first Position'.mysqli_error($link));
		}
		else if($i==1){$q="Update students_info set Class_Position='2nd out of $total_entries' WHERE Roll_No=".$qra['Roll_No'];
			mysqli_query($link,$q) or die('Error in 2nd Position'. mysqli_error($link));
		}
		else if($i==2){$q="Update students_info set Class_Position='3rd out of $total_entries' WHERE Roll_No=".$qra['Roll_No'];
			mysqli_query($link,$q) or die('Error in 3rd Position'. mysqli_error($link));
		}
		else if($i>2){$q="Update students_info set Class_Position=' $j th out of $total_entries' WHERE Roll_No=".$qra['Roll_No'];
		mysqli_query($link,$q) or die('Error in nth Position'. mysqli_error($link));
		}
		else{echo "Some thing is wrong";
		}	
	}
	if($cqe){echo "Data is Successfully Added to Positions";}
}


function empty_position_table($link){
	 $q="DELETE from position";
	$qr=mysqli_query($link,$q) or die('Error:in deletion'.mysqli_error($link));
	if($qr){
		return 1;
	}
	else
		return 0;
}


?>