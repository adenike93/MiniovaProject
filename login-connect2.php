

<?php 

if (isset($_POST["login_user"])){

    $email = $_POST["email"] ;
    $passWord = $_POST["password"] ;
 

    include "./connection.php" ; // Establishing connection with our database




    if(checkInputFields($email, $passWord) !== false) {
        header("location: ./login2.php?error=emptyinput"); 
        exit();
    }

    loginUser($db,$email, $passWord);

} else {
    header("location: ./login2.php"); 
    exit();
}
   
    // Check inputs if empty
    function checkInputFields($email, $passWord){
        $result = false;
        if( empty($email) || empty($passWord)){
            $result = true;
        }
        return $result;
    }



    //Login users with email address and password
    function loginUser($db,$email, $passWord){
        $usernameExist = userExist($db,$email, $email);

        if($usernameExist === false) {
            header("location: ./login2.php?error=wronglogindetails");
            exit();
        }
        
        $encryptedPassword = $usernameExist["password"];

        $passwordCheck = password_verify($passWord, $encryptedPassword);

        // echo "$encryptedPassword, $passWord";

        if($passwordCheck !== false) {
            header("location: ./login2.php?error=wrongpassword");
            exit();
        } elseif($passwordCheck !== true) {

            session_start();
            $_SESSION['user'] = $usernameExist["username"];

            if($_SESSION['user'] == "deniks"){
                $_SESSION['admin'] = "Admin";
                header("location: ./admin.php");
                exit(); 
            } else {
                header("location: ./index.php");
                exit();  
            }

        }
    
    }


    //check if user the user is in the database
    function userExist($db, $username, $email) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ? ;";
    
        $stmt = mysqli_stmt_init($db);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ./signup.php?error=stmtfailed"); 
            exit(); 
        }
    
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
    
        if ($row = mysqli_fetch_assoc($resultData)){
            return $row;
        } else {
           $result = false;
           return $result;
        }
    
       mysqli_stmt_close($stmt);
    }

