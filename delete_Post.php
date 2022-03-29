<?php 
 session_start();
?>

<?php


if(isset($_POST['action'])){

    if ($_POST["action"] == "delete") {

        deleteUserPost();
    }
}



function deleteUserPost(){

    include_once './connection.php';

    $postId = $_POST["id"];

    
    $sql = "SELECT * FROM experiencesupload WHERE idExperiences = $postId";
    $stmt = mysqli_stmt_init($db);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL statement failed!";
    } else {

        include_once './connection.php';
        
        $sql = "DELETE FROM experiencesupload WHERE idExperiences = $postId;";

        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_get_result($stmt);
        mysqli_stmt_get_result($stmt);
        echo 1;
    }
}
