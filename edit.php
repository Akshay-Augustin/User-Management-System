<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "usermanagement";

// to create the connection
$connection = new mysqli($servername, $username, $password, $database); 
$name="";
$email="";
$phone="";
$address="";

$errorMessage="";
$successmessage="";

if($_SERVER['REQUEST_METHOD']=='GET' ){

    if(!isset($_GET["id"])){
        header("location: /myuser/crud.php");
        exit;
    }
    $id=$_GET["id"];

    $sql="SELECT * FROM users WHERE id=$id";
    $result=$connection->query($sql);
    $row=$result->fetch_assoc();

    if(!$row){
        header("location: /myuser/crud.php");
        exit;
    }

    $name=$row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $address=$row["address"];



}
else {
    $id =$_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];

    do{
        if(empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage ="All the fields are required";
            break;
        }
        $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";

                $result =$connection->query($sql);

                if(!$result){
                    $errorMessage="Invalid query: " .$connection->error;
                    break;
                 }

                 $successmessage = "User updated correctly";

                 header("location: /myuser/crud.php");
        exit;

    }while(false);
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
        <h2>New User</h2>
        <?php
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        

        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" >

                </div><br> <br>
                <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" >
                </div> <br> <br>
                <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" >
                </div> <br> <br>
                <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div> <br> <br>
                <?php
                if(!empty($successmessage)){
                    echo"
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$successmessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div> ";
                }
                ?>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary"> Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a  class="btn btn-outline-primary" href="/myuser/crud.php" role="button">Cancel</a>

                    </div>

                </div>

            </div>
        </form>
</div>
    
</body>
</html>