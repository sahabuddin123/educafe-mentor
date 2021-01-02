<?php
include_once('./config/db.php');
/**
 * Form Submit Check
 */
if(isset($_REQUEST['submit'])){
  /**
   * Database Connection Check
   */
  if($dbh){
    /**
     * Terms and conditions
     */
    if($_REQUEST['agree'] == 1){
    /**
     * File Upload
     */
    if(strlen(basename($_FILES['image']['name'])) != 0){
      $tardir = "uploads/";
      $basePath = $tardir.basename($_FILES['image']['name']);
      if(move_uploaded_file($_FILES['image']['tmp_name'], $basePath)){
        $image = $basePath;
      }else
      {
        echo "Upload Fail!";
      }
    }
    else{
      $image = "";
    }
    /**
     * Insert Query
     */
    $sql = "INSERT INTO `admin`(`role_id`, `username`, `fname`, `lname`, `email`, `phone`, `dob`, `gander`, `image`, `password`)
     VALUES (?,?,?,?,?,?,?,?,?,?)";
     /**
      * Prepare Statement
      */
    $stmt = $dbh->prepare($sql);
    /**
     * BindParam
     */
    $stmt->bindParam(1, $_REQUEST['role_id']);
    $stmt->bindParam(2, $_REQUEST['username']);
    $stmt->bindParam(3, $_REQUEST['fname']);
    $stmt->bindParam(4, $_REQUEST['lname']);
    $stmt->bindParam(5, $_REQUEST['email']);
    $stmt->bindParam(6, $_REQUEST['phone']);
    $stmt->bindParam(7, $_REQUEST['dob']);
    $stmt->bindParam(8, $_REQUEST['gander']);
    $stmt->bindParam(9, $image);
    $stmt->bindParam(10, md5($_REQUEST['password']));
    /**
     * Insert Execute;
     */
    /**
     * Header location login.php if success!
     */
    if($stmt->execute()){
      header('location: login.php');
    }
    else{
      header('location: index.php');
    }
    }
    else{
      echo "<script>alert('Please Select Agree Button !');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Educafe - Admin registration</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app">
  <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Admin Registration</h1>
      </div>
<div class="row">
<div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label" for="role">Admin Role</label>
                  <select name="role_id" id="role" class="form-control">
                        <option value="1">Super Admin</option>
                        <option value="2">Admin</option>
                        <option value="3">Editor</option>
                        <option value="4">Author</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="username">User Name <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter user name" id="username" name="username">
                </div>
                <div class="row">
                <div class="col-6">
                <div class="form-group">
                  <label class="control-label" for="fname">First Name <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter first name" id="fname" name="fname">
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                  <label class="control-label" for="lname">Last Name <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter last name" id="lname" name="lname">
                </div>
                </div>
                </div>
                <div class="form-group">
                  <label class="control-label" for="email">Email<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter Email Address" id="email" name="email">
                </div>
                <div class="form-group">
                  <label class="control-label" for="phone">Phone Number<span class="text-danger">*</span></label>
                  <input class="form-control" type="tel" placeholder="88018xxxxxxxxx" id="phone" name="phone">
                </div>
                <div class="form-group">
                  <label class="control-label" for="dob">Date of Birth<span class="text-danger">*</span></label>
                  <input class="form-control" type="date"  id="dob" name="dob">
                </div>
                <div class="form-group">
                  <label class="control-label">Gender</label>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="gander" value="1">Male
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="gander" value="0">Female
                    </label>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label" for="image">Image</label>
                  <input class="form-control" type="file" name="image" id="image">
                </div>
                <div class="form-group">
                  <label class="control-label" for="password">Password <span class="text-danger">*</span></label>
                  <input class="form-control" type="password"  id="password" name="password">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="agree" value="1">I accept the terms and conditions
                    </label>
                  </div>
                </div>
              
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>
            </div>
          </div>
          </form>
        </div>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
   
  </body>
</html>