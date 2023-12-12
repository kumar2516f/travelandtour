
<?php
    include("layout/header.php");
    include("layout/user_session.php");

       ?>
       <div class="main">


       <style>
    /* Add your card styling here */
    .card {
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 20px;
    }

    .card img {
      width: 300px;
      height: 200px;
    }

    .card-content {
      padding: 20px;
    }

    h2 {
      color: #333;
    }

    p {
      color: #666;
    }
    
  </style>

      <div class="main">


<table>
  
  <?php
  include("layout/DB.php");
  $sql="SElECT * FROM package";
  $result=$conn->query($sql);
  if($result->num_rows > 0)
  {
    // $i=0;
    while($row=$result->fetch_assoc()){
   
      $pid=$row['pid'];
      $pname=$row['pname'];
      $p_start_destination=$row['p_start_destination'];
      $p_end_destination=$row['p_end_destination'];
      $days=$row['days'];
      $p_price=$row['p_price'];
      $p_image=$row['p_image'];
      $no_people=$row['no_people'];
        echo"
        <div class='card'>
        <img src='../uploads/$p_image' alt='Card Image' id='img-show'>
        <div class='card-content'>
          <h2>$pname</h2>
          Days= $days
          <br>
          Price=$p_price<br>
          Destination=$p_start_destination<br>
          Destination=$p_end_destination<br>
          No of people(capacity in vechile)  =$no_people <br>
          <form method='post' action='buy_package.php'>
        <input type='hidden' name='pid' value='$pid' >
        <input type='submit' name='buypackagebtn' id=' ' value='buy package'>
        </form>



        </div>
      </div>
        
        ";
    }
  }
  ?>


      <?php
    include("layout/footer.php");
       ?>
   <style>
    .main{
        display: flex;
    }
   </style>