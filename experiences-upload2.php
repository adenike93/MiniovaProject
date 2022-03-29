<?php 
 session_start()
?>

<?php 


if(isset($_POST["upload"])){

    $contentName = $_POST["content_name"];

    if(empty($_POST["content_name"])){

        $contentName = "Content upload";

    } else {
        $contentName = strtolower(str_replace(" ", "-",$contentName));
    }

    $contentDescription = $_POST["description"];
    $contentuserName = $_SESSION["user"];


    $file = $_FILES['file_name'];


    $contentFileName = $file['name'];
    $contentFileType = $file['type'];
    $contentFiletemp_name = $file['tmp_name'];
    $contentFileError = $file['error'];
    $contentFileSize = $file['size'];


    $fileExt = explode(".", $contentFileName);
    $fileMainExt = strtolower(end($fileExt));


    $acceptedFile = ['jpg', 'jpeg', 'png'];

    if(!in_array($fileMainExt, $acceptedFile )){
        echo "the required file type is jpg, jpeg or png.";
        exit();
    } else {
        if($contentFileError > 0) {
            echo 'file upload error';
            exit();
        } else {
            if ($contentFileSize > 400000000 ){
                echo "File size too large.";
            } else {
                $imageFullName = $contentName . "." . uniqid("", true). "." . $fileMainExt;
                $contentDestination = './assests/uploads/' .$imageFullName;

                include_once './connection.php';

                if(empty($contentuserName) || empty($contentName) || empty($contentDescription) || empty($contentFileName)){
                    header("Location: ./experiences2.php?upload=empty");
                } else {
                    $sql = "SELECT * FROM experiencesupload;";
                    $stmt = mysqli_stmt_init($db);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed!" ;
                        header("location: ./experiences2.php?error=stmtfailed"); 
                        exit(); 
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageposition = $rowCount + 1;

                        $sql = "INSERT INTO experiencesupload (usernameExperiences, titleExperiences, descExperiences, imgFullNameExperiences, orderExperiences) VALUES (?,?,?,?,?);";

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed!" ;
                        } else {
                            mysqli_stmt_bind_param($stmt, "sssss", $contentuserName, $contentName, $contentDescription, $imageFullName, $setImageposition);
                            mysqli_stmt_execute($stmt);


                            move_uploaded_file($contentFiletemp_name, $contentDestination);
                            

                            if($_SESSION["user"] == 'Denike'){
                                header("Location: ../admin.php?upload=success");  
                            }
                            header("Location: ./experiences2.php?upload=success");
                        }
                    }
                }
            }
        }
        
    }

}




















?>