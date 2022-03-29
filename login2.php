<?php 
 include ('./templates/header.php')
 ?>

<form action = "login-connect2.php" method = "post">
     <div class="image container"> 
         <img src="././assests/images/E.jpg" alt="Login-img" class= "loginn">
           <div class="container">
         <div class="row justify-content-center mt-2"id="mide"> 
          <div class="col-sm-offset-4 col-sm-4">
                  <div class="mb-3">
                      <label for="exampleInputEmail" class="form-label" id="email">Email  address</label>
                      <input type="email" class="form-control" name ="email">
                  </div>
                 <div class="mb-3">
                     <label for="exampleInputPassword" class="form-label"id="password">Password</label>
                     <input type="password" class="form-control" name = "password">
                  </div>
                 <button type="submit" name ="login_user" class="btn btn-primary">Login</button>
</form>
               <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
         </div>
     </div>
  </body>
</html> -->
