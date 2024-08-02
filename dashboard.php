
<?php
  
    session_start();

    if(!isset($_SESSION['user'])){
        header("location: login.php");
    }

?>

<?php
    require_once 'header.php'; 
?>

<section>
    <div class="container">
        <div class="row justify-content-center mt-5">
            
            <div class="col-lg-6">
                <div class="mb-3 text-cente">
                    <?php
                    if(isset($_SESSION['email'])){
                        echo $_SESSION['email']; 
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3 text-center">
                    <a class='bg-danger text-white rounded p-3' href="logout.php">logout</a>
                </div>
            </div>
            
        </div>
        <div class="row justify-content-center mt-5">
            
            <div class="col-lg-6">
                <h3>Welcome to </h3>
            </div>
            
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 ">
            <?php
                if(isset($_SESSION['success-msg'])){
                    echo $_SESSION['success-msg'];
                    unset($_SESSION['success-msg']);
                }
                // unset( $_SESSION['success-msg']);
            ?>
        </div>
    </div>
</section>

    <?php
    require_once 'footer.php'; 
?>