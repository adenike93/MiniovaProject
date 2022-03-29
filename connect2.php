<?php 
if (isset($_POST["submit"])){

    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];




    include "./connection.php" ; // Establishing connection with our database


    if(isInputEmpty($userName, $email, $password, $confirm_password) === true) {
        header("location: ./signup2.php?error=emptyinput"); 
        exit();
    }

    if(isValidUsername($userName) === false) {
        header("location: ./signup2.php?error=invalidusername"); 
        exit();
    }

    if(isValidEmail($email) === false) {
        $SESSION['error_message'] = 'Invalid email address provided';
        header("location: ./signup2.php?error=invalidemail"); 
        exit();
    }



    if(passwordMatch($password, $confirm_password) === false) {
        header("location: ./signup2.php?error=passwordnotsame"); 
        exit();
    }

    if(userExist($db,$userName,$email) !== false){
        header("location: ./signup2.php?error=usernamenotavailable"); 
        exit();
    }


    createUserAccount($db, $userName, $email, $password);


} else {
     header("location: ./signup2.php");
}


// checking for error handling
function isInputEmpty($email, $userName, $password, $confirm_password){
    $result = false;
    if(empty($email) || empty($userName) || empty($password) || empty($confirm_password)){
        $result = true;
    }
    return $result;
}


function isValidUsername($userName){
    $result = true;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $userName)){
        $result = false;
    }
    return $result;
}


function isValidEmail($email){
    $result = true;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = false;
    } 
    return $result;
}

function passwordMatch($password, $confirm_password){
    $result = true;
    if($password !== $confirm_password){
        $result = false;
    } 
    return $result;
}



function userExist($db, $userName, $email) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ? ;";

    $stmt = mysqli_stmt_init($db);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup2.php?error=stmtfailed"); 
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
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



function createUserAccount($db,$userName, $email, $password){

    $sql = "INSERT INTO users (username, email, password) VALUE (?,?,?);";

    $stmt = mysqli_stmt_init($db);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signup2.php?error=stmtfailed"); 
        exit(); 
    }

    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, 'sss', $userName, $email,  $encryptedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ./signup2.php?error=none"); 
    exit();
}





































