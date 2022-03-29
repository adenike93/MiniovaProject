<?php 
 include ('./templates/header.php');
 ?>
   <div id="DESTINATIONS" class="container marketing destination">
                   <h2 class="text-center" style="color:green">Hello,  <?php 
                      echo ucfirst($_SESSION['user']);
                   ?></h2>
                    <hr class='featurette-divider'>
                    <?php 
                        include ("./connection.php");
                        $username = $_SESSION['user'];
                        $sql = "SELECT * FROM experiencesupload WHERE usernameExperiences = '$username'";
                        $stmt = mysqli_stmt_init($db);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed!";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            while($row = mysqli_fetch_assoc($result)){
                                $experience_user = ucfirst($row["titleExperiences"]);
                                $experience_content_name = ucfirst($row["descExperiences"]);
                                $experience_username = ucfirst($row["usernameExperiences"]);

                                echo "
                                <div class='row featurette' id='$row[idExperiences]'>
                                 <div class='col-md-7'>
                                    <h2 class='featurette-heading'>$experience_user<span class='text-muted' style='font-size: 13px; margin-left: 14px'>Posted by $experience_username</span></h2>
                                    <p class='lead'>$experience_content_name </p>
                                    </div>
                                    <div class='col-md-5'>
                                       <img class='featurette-image img-fluid mx-auto' src='./assests/uploads/$row[imgFullNameExperiences]' alt='pix1L'>
                                    </div>
                                    <button style='color:red;font-weight: bold; width: 20px; margin: auto; border: 1px solid red; border: none' name='delete' onClick = 'deletePost($row[idExperiences])'>X</button>
                                 </div>
                                 <hr class='featurette-divider'>
                                " ; 
                            }
                        }
                    ?>     
      </div>
    <section id="contact" class="bg-light py-1 mt-3">
        <div class="container-lg">
           <div class="text-center mt-5">
               <h2>Upload your stories.</h2>
           </div>
           <div class="row justify-content-center my-5">
               <div class="col-lg-6">
               <form class="row g-3" method="POST" action="./experiences-upload2.php" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label for="content_name" class="form-label">EXPERIENCE NAME</label>
                        <input type="text" name="content_name" class="form-control" id="content_name" placeholder="Story name">
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">EXPERIENCE:</label>
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="Share your experience" id="description"></textarea>
                            <label for="floatingTextarea">Share your experience....</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="img_name" class="form-label">UPLOAD</label>
                        <input type="file" name="file_name" class="form-control" id="img_name">
                    </div>
                    <div class="col-md-12 text-center" >
                        <button type="submit" name="upload" class="btn btn-primary" style="width: 50%;">Upload</button>
                    </div>
                </form>
               </div>
           </div>
        </div>
    </section>

    <script >
         function deletePost(id){
            $(document).ready(function (){

            $.ajax({
               
               url: './delete_Post.php',
               type: 'POST',
               data: {
                     id: id,
                     action: 'delete'
               },
               success:function(response){
                     if(response == 1){
                        alert('Post deleted');
                        document.getElementById(id).style.display= 'none';
                     } else if (response == 0){
                        alert("Unable to delete post");
                     }
               },
            });
         });
         }

    </script>
<?php 
    include_once './templates/footer.php';
?>
