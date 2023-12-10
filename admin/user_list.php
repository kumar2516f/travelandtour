
<?php
    include("a_layout/a_header.php");
    include("a_layout/a_session.php");
       ?>
       
       <style>
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th, td {
    /* border: 1px solid #ddd; */
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #4CAF50;
    color: black;
  }

  /* tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #ddd;
  } */

  #p_img{
    height: 50px;
    width: 50px;
  }
  
</style>
      <div class="main">
      <table>
  <tr>
    <th width="10%">sn</th>
    <th width="30%">user Name</th>
    <th width="15%"> user phone</th>
    <th width="30%">email</th>
 
  </tr>
      <?php
  include("a_layout/DB.php");
  $sql="SElECT * FROM user";
  $result=$conn->query($sql);
  if($result->num_rows > 0)
  {
    $i=1;
    while($row=$result->fetch_assoc()){
   
      $uid=$row['uid'];
      $uname=$row['uname'];
      $uphone=$row['uphone'];
      $email=$row['email'];
      
        echo"
        <tr>
        <td>$i</td>
        <td>$uname</td>
        <td>$uphone</td>
        <td>$email</td>
    
      </tr>
        
        ";
        $i++;
    }
  }
  ?>


      </div>

      
      <?php
    include("a_layout/a_footer.php");
       ?>
   