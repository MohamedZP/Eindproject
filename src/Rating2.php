<?php 
include 'connect.php';

if (isset($_POST['rating_data'])) {
	
	$data = array(

		':user_name'     =>  $_POST['user_name'],
		':user_data'     =>  $_POST['rating_data'],
		':user_review'   =>  $_POST['user_review'],
		':datetime'      =>  time()

	);

	$sql = "INSERT INTO tblrating(user_name, user_rating, user_review, datetime) 
			VALUES (:user_name, :user_data, :user_review, :datetime )";

	$statement = $connect-> prepare($sql);

	$statement -> execute($data);

	echo "Your review & rating is succesfully submitted";

}

?>
