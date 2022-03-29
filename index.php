
<?php 
    include_once './templates/header.php';
?>
      <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./assests/images/SLIDE 1.png" class="first slide" alt="first slide">
      <div class="carousel-caption d-none d-md-block">
        <h1>THE CITIES OF SCOTLAND.</h1>
        <p>See Through Our Eyes and Discover Your Best Trip. Happy Holidays!!!.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./assests/images/SLIDE 2.png" class="second slide" alt="second slide">
      <div class="carousel-caption d-none d-md-block">
        <h1>EXPLORE THE CITIES OF SCOTLAND.</h1>
        <p>See Through Our Eyes and Discover Your Best Trip. Happy Holidays!!!.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./assests/images/SLIDE 3.png" class="third slide" alt="third slide">
      <div class="carousel-caption d-none d-md-block">
        <h1>THE CITIES OF SCOTLAND.</h1>
        <p>See Through Our Eyes and Discover Your Best Trip. Happy Holidays!!!.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
   <div id="DESTINATIONS" class="container marketing destination">
                    <?php 
                         include ("./connection.php");
                        $sql = "SELECT * FROM experiencesupload ORDER BY orderExperiences DESC";
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
                                    <div class='row featurette'>
                                    <div class='col-md-7'>
                                    <h2 class='featurette-heading'>$experience_user<span class='text-muted' style='font-size: 13px; margin-left: 14px'>Posted by $experience_username</span></h2>
                                    <p class='lead'>$experience_content_name </p>
                                    </div>
                                    <div class='col-md-5'>
                                        <img class='featurette-image img-fluid mx-auto' src='./assests/uploads/$row[imgFullNameExperiences]' alt='pix1L'>
                                    </div>
                                    </div>
                                
                                    <hr class='featurette-divider'>
                                " ; 
                            }
                        }
                    ?>     
            </div>
       </div>  
<?php 
    include_once './templates/footer.php';
?>
