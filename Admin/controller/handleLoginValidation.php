<?php
session_start();
require_once '../../common/model/DatabaseConnection.php';

$email=$_POST['email']??'';
$password=$_POST['password']??'';

if(!$email||!$password){
    $_SESSION['loginErr']="Required";
    header("Location: ../view/login.php"); exit;
}

$db=new DatabaseConnection();
$conn=$db->openConnection();

$stmt=$conn->prepare("SELECT * FROM user WHERE user=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$res=$stmt->get_result();

if($res->num_rows==0){
    $_SESSION['loginErr']="Invalid";
    header("Location: ../view/login.php"); exit;
}

$row=$res->fetch_assoc();

if(!password_verify($password,$row['password'])){
    $_SESSION['loginErr']="Invalid";
    header("Location: ../view/login.php"); exit;
}

if($row['approval_status']!=1){
    $_SESSION['loginErr']="Pending approval";
    header("Location: ../view/login.php"); exit;
}

$_SESSION['isLoggedIn']=true;
$_SESSION['role']=$row['role'];

if($row['role']=="Admin"){
    header("Location: ../view/approve.php"); exit;
}

header("Location: ../view/login.php"); exit;
