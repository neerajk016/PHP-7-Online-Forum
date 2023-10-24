<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    #ques{
      min-height: 433px;
    }
  </style>
  <title>iDiscuss Coding-Forums</title>
</head>

<body>
  <?php include "partials/_dbconnect.php"?>
  <?php include "partials/_header.php"?>
  <?php
    
    $id = $_GET['categoryid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id"; 
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)){
      
      $name = $row['category_name'];
      $description = $row['category_description'];
    }
    
  ?>
  <?php
  $showalert=false;
  $method=$_SERVER['REQUEST_METHOD'];
  // echo $method;
  if($method=="POST"){
    $th_title=$_POST['title'];
    $th_desc=$_POST['desc'];
    $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showalert=true;
  }
  if($showalert){
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>SUCCESS!</strong> Your Thread has been Added
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  
  ?>


  <div class="container">
    <div class="mt-4 p-5 bg-secondary text-white rounded">
      <h1 class="display-4">Welcome to
        <?php echo $name;?> Forum
      </h1>
      <p class="lead">
        <?php echo $description;?>
      </p>
      <hr class="my-4">
      <p>Don’t challenge or attack others. The discussions on the forum are meant to stimulate conversation, not to
        create contention. Let others have their say, just as you may.Don’t post commercial messages. Contact people
        directly with product and service information if you believe it would help them.All defamatory, abusive,
        profane, threatening, offensive, or illegal materials are strictly prohibited. Do not post anything in a post
        message that you would not want the world to see or that you would not want anyone to know came from you.</p>
      <p class="lead">
        <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
      </p>
    </div>




  </div>

  <div class="container">
    <h1 class="py-2">Start a Discussion</h1>
    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Problem Title</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Keep Your Title as Short and Crisp as Possible</div>
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Ellaboarte Your Concern</label>
        <textarea class="form-control" name="desc" id="desc"  rows="3"></textarea>
      </div>
      
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>






  <div id="ques" class="container">
    <h1 class="py-2">Browse Questions</h1>

    
    
    

    <?php
    
    $id = $_GET['categoryid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noresult=True;
    while($row = mysqli_fetch_assoc($result)){
      $noresult=False;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $description=$row['thread_description'];

        echo "
        <div class='d-flex mt-4'>
          <img src='img/user.jpg' alt='Anna Doe' class='me-3 rounded-circle' style='width: 60px; height: 60px;' />
          <div>
            <h5 class='fw-bold'>
              <a href='thread.php?threadid=".$id."'>".$title."</a>
            </h5>
            <p>
             ".$description."
            </p>
          </div>
        </div>";

    }

    if($noresult){
      echo "
      <div class='mt-4 p-5 bg-secondary text-white rounded'>
        <h1 class='display-4'>
          No Threads Found
        </h1>
        <hr class='my-4'>
        <p class='lead'>
          Be The First Person to Ask
        </p>
        
        
      </div>
      
      ";
    }
    
    ?>


    
      

  </div>

  <?php include "partials/_footer.php"?>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>