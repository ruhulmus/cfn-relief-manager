 <?php
	header('Content-Type: application/json');

   include("config.php");
   //include("get_data_by_field.php");
    
  // $row=null; 
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
    
    $distribute_type = $_POST['distribute_type'];

 
      
 	date_default_timezone_set('Asia/Dhaka');
	$date = date('Y-m-d H:i:s');
 
	if (isset($distribute_type) && $distribute_type == 1 ){
	    $sql = "SELECT * FROM distribute_info WHERE date_of_distribution <= '$date'";
		$result = mysqli_query($conn, $sql);
	}
	else if (isset($distribute_type) && $distribute_type == 2 ){
		$sql = "SELECT * FROM distribute_info WHERE date_of_distribution > '$date'";
		$result = mysqli_query($conn, $sql);
	}

			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    
			    while($row = $result->fetch_assoc()) {
			    	 
					$sql3 = "SELECT * FROM users WHERE id='".$row["user_id"]."'";
					$result3 = mysqli_query($conn,$sql3);
					$row3=mysqli_fetch_array($result3);


					$sql2 = "SELECT * FROM upazilas WHERE id='".$row["upazila_id"]."'";
					$result2 = mysqli_query($conn,$sql2);
					$row2=mysqli_fetch_array($result2);

					$sql4 = "SELECT * FROM districts WHERE id='".$row2["district_id"]."'";
					$result4 = mysqli_query($conn,$sql4);
					$row4=mysqli_fetch_array($result4);


					if ($row3['type'] ==1 ){
				    	$user_type="Indivitual";
				    }
				    else if ($row3['type'] ==2 ) {
						$user_type="Private Welfare Organization";
				    }
				    else if ($row3['type'] ==3 ) {
						$user_type="Govt Organization";
				    }
 
			            $data['distribution_list'][] = [
		                'user_id'=>$row["user_id"],
		                'user_name'=>$row3['name'],
		                'ueser_phone'=>$row3["phone"],
		                'user_email'=>$row3['email'],
		                'user_type'=>$user_type,
		 		        'upazila_id'=>$row["upazila_id"],
				        'upazila_name'=>$row4['name'] ." > ". $row2["name"],
				        'upazila_name_bn'=>$row4['bn_name'] ." > ". $row2["bn_name"],
				        'upazila_latitude'=>$row2["latitude"],
				        'upazila_longitude'=>$row2["longitude"],
				        'no_of_family'=>$row["no_of_family"],
				        'releife_items'=>$row["releife_items"],
				        'survival_day'=>$row["survival_day"],
				        'is_needed'=>$row["is_needed"],
				        'status'=>$row["status"],
				        'is_needed_detials'=>$row["is_needed_detials"],
				        'date_of_distribution'=>$row["date_of_distribution"],
				        'address'=>$row["address"],
				        'distribution_latitude'=>$row["latitude"],
		        		'distributtion_longitude'=>$row["longitude"]
		            ];

			        
	 			    }
				}
				 
			 else {
			 $data['status'] = "401";
	         $data['msg']="failed";
			}
			$conn->close();

}
else{
	$data['status'] = "501";
	$data['msg']="method is not allowed";
}
	echo json_encode($data);
		
 
?>