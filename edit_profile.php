<?php
include 'config.php';
session_start();
$id=$_SESSION['id'];
 if(isset($_POST['submit'])){
    $fullname = $_POST['username'];
    $password = $_POST['password'];
  $query = "UPDATE users SET username = '$fullname',
                  password = '$password' WHERE id = '$id'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                ?>
                 <script type="text/javascript">
        alert("Zaktualizowałeś poprawnie.");
        window.location = "index.php";
    </script>
<?php
    }               
?>