
<?php
session_start();

//login thakle dashboard ai nia jabe
if(isset($_SESSION['user'])){
    header("location: dashboard.php");
}
// $_SESSION['user'] ='';
  
$errpassword = $err_checking_email = $erremail =$err_pass= '';

  $host_name= 'localhost';
  $user_name= 'root';
  $password= '';
  $database_name= 'login';

    $db_connection = mysqli_connect($host_name, $user_name, $password, $database_name);

  if(isset($_POST['submit'])){
    
   $email =  $_POST['email'];
   $create_password =  $_POST['create_password'];



    
    if(empty($create_password)){
        $errpassword = 'fill up the form.';
        // echo $errpassword;
    }

    
    if(empty($email)){
        $erremail = 'fill up the form.';
        // echo $erremail;
    }else{
        $mdpas = md5($create_password);
        $check_query = "SELECT COUNT(*) As user_count FROM users WHERE email= '$email' AND password='$mdpas'";
        $after_cheking = mysqli_query($db_connection, $check_query);
        // print_r($after_cheking);
        $after_assoc = mysqli_fetch_assoc($after_cheking);
        // print_r($after_assoc);

        if($after_assoc['user_count'] > 0){
            // echo 'login';
            $_SESSION['success-msg'] = 'login successfull!';

            //user sesssion
            $_SESSION['user']= 'he is a user.';

            //use this email into dashboard
            $_SESSION['email']= $email;

            //navigate`
            header("location: dashboard.php");
        }else{
           $err_pass =  'password not match';
        }







    }




  }

?>




<?php
    require_once 'header.php'; 
?>

<section>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
                <form action='login.php' method='POST'>
                    <div class="mb-3 text-center">
                       <h3>Login</h3>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name='email'>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$erremail. "</span>"; } ?>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$err_checking_email. "</span>"; } ?>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name='create_password'>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$errpassword. "</span>"; } ?>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$err_pass. "</span>"; } ?>
                    </div>
                    <button type="submit" name='submit' class="btn btn-primary">Login</button>
                </form>
                <p>Have already Account? <a href="registration.php">Registration</a></p>
            </div>
        </div>
    </div>
</section>

    <?php
    require_once 'footer.php'; 
?>