
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
<?php
if(isset($_POST["delbtn"])){
$pid=$_POST["pid"];
include("a_layout/DB.php");
$sql = "DELETE FROM package WHERE pid='$pid'";
            $result = $conn->query($sql);

            if ($result) {
                echo "<script>
                    alert('delete successful');
                    window.location.href='package.php';
                </script>";
            } else {
                echo "<script>
                    alert('delete failed');
                    window.location.href='package.php';
                </script>";
            }

}
?>
       

      <div class="main">

      <a href="add_package.php" style=" background-color: black; color: white; text-decoration: none; ">ADD</a>

<table>
    <tr>
      <th width="5%">sn</th>
      <th width="15%">Package Name</th>
      <th width="15%">Start Destination</th>
      <th width="20%">Final Destination</th>
      <th width="10%">days</th>
      <th width="10%">price</th>
      <th width="10%">no of no_people</th>
      <th width="10%">image</th>
      <th width="10%">action</th>
    </tr>
  <?php
  include("a_layout/DB.php");
  $sql="SElECT * FROM package";
  $result=$conn->query($sql);
  if($result->num_rows > 0)
  {
    $i=1;
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
        <tr>
        <td>$i</td> 
        <td>$pname</td>
        <td>$p_start_destination</td>
        <td>$p_end_destination</td>
        <td>$days</td>
        <td>$p_price</td>
        <td>$no_people</td>
        <td><img src='../uploads/$p_image' id='p_img'> </td>
        <td>
        <form method='post' action='edit_package.php'>
        <input type='hidden' name='pid' value='$pid' >
        <input type='submit' name='editbtn' id=' ' value='edit'>
        </form>
        <form method='post' action='package.php'>
        <input type='hidden' name='pid' value='$pid' >
        <input type='submit' name='delbtn' id=' ' value='delete'>
        </form>
        
        
        </td>
      </tr>
        
        ";
        $i++;
    }
  }
  ?>

</table>
    </div>

      
      <?php
    include("a_layout/a_footer.php");
       ?>
   