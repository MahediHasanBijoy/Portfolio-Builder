<?php 
require_once('../db.inc.php');

$errors = array();


//if user clicks on the add_about save button.
if(isset($_POST['add_about_btn'])){
	$about_you = $_POST['about_you'];
	$profession = $_POST['profession'];
	$birthday = $_POST['birthday'];
	$age = $_POST['age'];
	$website = $_POST['website'];
	$degree = $_POST['degree'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	$about_del = 0;

	$sql = "INSERT INTO about (about_you, profession, birthday, age , website, degree, phone, email, city, about_del, about_date) VALUES ('$about_you','$profession', '$birthday', '$age', '$website', '$degree', '$phone', '$email', '$city', '$about_del', now()) ";
	$result = $db->query($sql);
	if ($db->error) {
		exit("sql error!");
	}

}
/*--RESUME SECTION START--*/
//--Add Resume
//if user clicks on the save_summary button
if(isset($_POST['save_summary'])){
	$name = $_POST['name'];
	$about = $_POST['about'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	

	$sql = "INSERT INTO resume_summary (summary_name, summary_about, summary_address, summary_phone , summary_email, summary_date) VALUES ('$name','$about', '$address', '$phone', '$email', now()) ";
	$result = $db->query($sql);
	if ($db->error) {
		exit("sql error!");
	}
/*	if ($result) {
     echo "<span class='success'>Image Inserted Successfully.
     </span>";
 	}*/

}
//if user clicks on the save_education button
if(isset($_POST['save_education'])){
	$degree = $_POST['degree'];
	$session = $_POST['session'];
	$institutename = $_POST['institutename'];
	$description = $_POST['description'];
	

	$sql = "INSERT INTO resume_education (degree, session, institute, description) VALUES ('$degree','$session', '$institutename', '$description')";
	$result = $db->query($sql);
	if ($db->error) {
		exit("sql error!");
	}
/*	if ($result) {
     echo "<span class='success'>Image Inserted Successfully.
     </span>";
 	}*/

}
//if users clicks on the save_professional_experience button
if(isset($_POST['save_professional_experience'])){
	$designation = $_POST['designation'];
	$years = $_POST['years'];
	$companyname = $_POST['companyname'];
	$description = $_POST['description'];
	

	$sql = "INSERT INTO professional_experience (designation, years, company_name, description) VALUES ('$designation','$years', '$companyname', '$description')";
	$result = $db->query($sql);
	if ($db->error) {
		exit("sql error!");
	}
/*	if ($result) {
     echo "<span class='success'>Image Inserted Successfully.
     </span>";
 	}*/

}

//--Update Resume
//updation resume_summary
if (isset($_POST['update_resume_summary'])) {
	$name = $_POST['name'];
	$about = $_POST['about'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$sql = "UPDATE resume_summary SET summary_name='$name', summary_about='$about', summary_address='$address', summary_phone='$phone', summary_email='$email', summary_date= now() ORDER BY summary_date DESC LIMIT 1 ";
		$result = $db->query($sql);
		if ($db->error) {
			exit("sql error!");
		}


}
//update resume_education
if (isset($_POST['update_resume_education'])) {
	$degree = $_POST['degree'];
	$session = $_POST['session'];
	$institutename = $_POST['institutename'];
	$description = $_POST['description'];

	$sql = "UPDATE resume_education SET degree='$degree', session='$session', institute='$institutename', description='$description' ";
		$result = $db->query($sql);
		if ($db->error) {
			exit("sql error!");
		}

}
//update resume_professional_experience
if (isset($_POST['update_resume_prof_experience'])) {
	$designation = $_POST['designation'];
	$years = $_POST['years'];
	$companyname = $_POST['companyname'];
	$description = $_POST['description'];

	$sql = "UPDATE professional_experience SET designation='$designation', years='$years', company_name='$companyname', description='$description' ";
		$result = $db->query($sql);
		if ($db->error) {
			exit("sql error!");
		}

}


/*--BLOG SECTION START--*/
//if user clicks on the add_blog save button
if(isset($_POST['add_blog_save'])){
	$add_blog_title = $_POST['blog_title'];
	$add_blog_author = $_POST['author'];
	$add_blog_post =$_POST['blog_post'];
	$add_blog_del = 0; 

	//upload image 
	$permited  = array('jpg', 'jpeg', 'png', 'gif');
	$file_name = $_FILES['upload_image']['name'];
	$file_size = $_FILES['upload_image']['size'];
	$file_temp = $_FILES['upload_image']['tmp_name'];

	$div = explode('.', $file_name);
	$file_ext = strtolower(end($div));
	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	$uploaded_image = "../admin/uploads/".$unique_image;


    //validation of image
	if (empty($file_name)) {
     // echo "<span class='error'>Please Select any Image !</span>";
		$errors['upload_image'] = 'Please Select any Image!';
	}elseif ($file_size >1048567) {
     // echo "<span class='error'>Image Size should be less then 1MB!
     // </span>";
		$errors['upload_image'] = 'Image Size should be less then 1MB!';
	} elseif (in_array($file_ext, $permited) === false) {
     // echo "<span class='error'>You can upload only:-"
     // .implode(', ', $permited)."</span>";
		$errors['upload_image'] = 'You can upload only:-'.implode(', ',$permited);
	} else{
		move_uploaded_file($file_temp, $uploaded_image);
    // $query = "INSERT INTO tbl_image(image) 
    // VALUES('$uploaded_image')";
    // $inserted_rows = $db->insert($query);
    // if ($inserted_rows) {
    //  echo "<span class='success'>Image Inserted Successfully.
    //  </span>";
    // }else {
    //  echo "<span class='error'>Image Not Inserted !</span>";
    // }
		$sql = "INSERT INTO add_blog (add_blog_title, add_blog_author, add_blog_date, add_blog_img , add_blog_post, add_blog_del) VALUES ('$add_blog_title','$add_blog_author', now(), '$uploaded_image', '$add_blog_post', '$add_blog_del') ";
		$result = $db->query($sql);
		if ($db->error) {
			exit("sql error!");
		}
		else{
			header('location:addblog.php');
		}

	}


}

//if user clicks edit_blog update button
if(isset($_POST['edit_blog_update'])){
	// for the id of the blog which will edit
	if (isset($_GET['edit-blog'])) {
	  $edit_blog_id = $_GET['edit-blog']; 
	}
	$edit_blog_title = $_POST['edit_blog_title'];
	$edit_blog_author = $_POST['edit_author'];
	$edit_blog_post =$_POST['edit_blog_post'];
	$edit_blog_del = 0; 

	//upload image 
	$permited  = array('jpg', 'jpeg', 'png', 'gif');
	$file_name = $_FILES['edit_upload_image']['name'];
	$file_size = $_FILES['edit_upload_image']['size'];
	$file_temp = $_FILES['edit_upload_image']['tmp_name'];

	$div = explode('.', $file_name);
	$file_ext = strtolower(end($div));
	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	$uploaded_image = "../admin/uploads/".$unique_image;


    //validation of image
	if (empty($file_name)) {
     // echo "<span class='error'>Please Select any Image !</span>";
		// $errors['upload_image'] = 'Please Select any Image!';
		$sql = "UPDATE add_blog SET add_blog_title='$edit_blog_title', add_blog_author='$edit_blog_author', add_blog_date=now(), add_blog_post='$edit_blog_post' WHERE add_blog_id='$edit_blog_id' ";
		$result = $db->query($sql);
		if ($db->error) {
			exit("sql error!");
		}
		else{
			header('location:edit_blog_post.php?edit-blog='.$edit_blog_id);
		}

	}elseif ($file_size >1048567) {
     // echo "<span class='error'>Image Size should be less then 1MB!
     // </span>";
		$errors['upload_image'] = 'Image Size should be less then 1MB!';
	} elseif (in_array($file_ext, $permited) === false) {
     // echo "<span class='error'>You can upload only:-"
     // .implode(', ', $permited)."</span>";
		$errors['upload_image'] = 'You can upload only:-'.implode(', ',$permited);
	} else{
		move_uploaded_file($file_temp, $uploaded_image);
    // $query = "INSERT INTO tbl_image(image) 
    // VALUES('$uploaded_image')";
    // $inserted_rows = $db->insert($query);
    // if ($inserted_rows) {
    //  echo "<span class='success'>Image Inserted Successfully.
    //  </span>";
    // }else {
    //  echo "<span class='error'>Image Not Inserted !</span>";
    // }
		$sql = "UPDATE add_blog SET add_blog_title='$edit_blog_title', add_blog_author='$edit_blog_author', add_blog_date=now(), add_blog_img='$uploaded_image' , add_blog_post='$edit_blog_post' WHERE add_blog_id='$edit_blog_id' ";
		$result = $db->query($sql);
		if ($db->error) {
			exit("sql error!");
		}
		else{
			header('location:edit_blog_post.php?edit-blog='.$edit_blog_id);
		}

	}


}

?>