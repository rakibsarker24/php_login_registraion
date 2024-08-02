
<?php
  
  $errname = $err_len_name=  $errpassword =$errcpassword = $pass_not_match = $erremail = $err_checking_email= '';

  $host_name= 'localhost';
  $user_name= 'root';
  $password= '';
  $database_name= 'login';

    $db_connection = mysqli_connect($host_name, $user_name, $password, $database_name);

  if(isset($_POST['submit'])){
    
   $name =  $_POST['name'];
   $email =  $_POST['email'];
   $create_password =  $_POST['create_password'];
   $confrim_password =  $_POST['confrim_password'];



    if(empty($name)){
        $errname = 'fill up the form.';
        // echo $errname;
    }else{
        if(strlen($name) <3 ){
            $err_len_name= 'name must more than 3 char';
            // echo $errname;
        }
    }

    
    
    if(empty($create_password)){
        $errpassword = 'fill up the form.';
        // echo $errpassword;
    }
    
    
    if(empty($confrim_password)){
        $errcpassword = 'fill up the form.';
        // echo $errcpassword;
    }else{
        if($confrim_password !== $create_password){
            $pass_not_match = 'password not match.';
            // echo $pass_not_match;
        }
    }
    
    if(empty($email)){
        $erremail = 'fill up the form.';
        // echo $erremail;
    }else{

        $check_query = "SELECT COUNT(*) As total_count FROM users WHERE email= '$email'";
        $after_cheking = mysqli_query($db_connection, $check_query);
        // print_r($after_cheking);
        $after_assoc = mysqli_fetch_assoc($after_cheking);
        // print_r($after_assoc);

        if($after_assoc['total_count'] > 0){
            $err_checking_email = 'this eamil already used.';
        }else{
            $md_password = md5($create_password);
            $insert_query = " INSERT INTO users(name, email, password) VALUES('$name', '$email', '$md_password')";
    
            mysqli_query($db_connection, $insert_query);
            header("location: login.php");
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
                <form action='registration.php' method='POST'>
                    <div class="mb-3 text-center">
                       <h3>Registration</h3>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Your Name</label>
                        <input type="text" class="form-control" name='name'>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$errname. "</span>"; } ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name='email'>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$erremail. "</span>"; } ?>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$err_checking_email. "</span>"; } ?>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Create Password</label>
                        <input type="password" class="form-control" name='create_password'>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$errpassword. "</span>"; } ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Re-entewr Password</label>
                        <input type="password" class="form-control" name='confrim_password'>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$errcpassword. "</span>"; } ?>
                        <?php if(isset($_POST['submit'])){ echo "<span class='text-danger'>" .$pass_not_match. "</span>"; } ?>
                    </div>
                    <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                </form>
                <p>Have an Account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</section>

    <?php
    require_once 'footer.php'; 
?>