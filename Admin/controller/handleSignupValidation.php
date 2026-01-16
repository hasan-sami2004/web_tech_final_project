<?php
session_start();
require_once '../../common/model/DatabaseConnection.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if(!$email || !$password || !$role){
    $_SESSION['signUpErr']="All fields required";
    header("Location: ../view/signup.php"); exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$chk = $conn->prepare("SELECT user_id FROM user WHERE user=?");
$chk->bind_param("s",$email);
$chk->execute();
if($chk->get_result()->num_rows>0){
    $_SESSION['signUpErr']="User exists";
    header("Location: ../view/signup.php"); exit;
}

$approval = ($role==="Admin")?0:1;
$hash = password_hash($password,PASSWORD_DEFAULT);

$stmt=$conn->prepare("INSERT INTO user(user,password,role,approval_status) VALUES(?,?,?,?)");
$stmt->bind_param("sssi",$email,$hash,$role,$approval);
$stmt->execute();

$_SESSION['signupMsg']=($approval==0)?"Admin pending approval":"Signup success";
header("Location: ../view/login.php"); exit;
