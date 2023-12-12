
<?php
    include("layout/header.php");
    include("layout/user_session.php");

// include("layout/a_session.php");

       ?>
       
      
<style>
    .add_package {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        max-width: 100%;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        color: #555;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
<?php
    if(isset($_POST['buy_package'])){
    include('layout/DB.php');
       
        $pid=$_POST['pid'];
        $date=$_POST['date'];

        $selectedTimestamp = strtotime($date);
        // Get the current timestamp in Kathmandu timezone
        $currentTimestamp = time();
        
        // Compare the selected date's timestamp with the current timestamp
        if ($selectedTimestamp < $currentTimestamp) {
            echo "
            <script>
            alert('invalid date. Date should be more than today');
            window.location.href='user_package.php';
            </script>";
            die();
        } 

    $sql="INSERT INTO `bookings` (`bid`, `uid`, `pid`, `b_date`, `status`) VALUES (NULL, ' $uid', '$pid', '$date', 'pending')";
    $result = $conn->query($sql);
    if($result)
    {
        echo "<script>
        alert('package booked and waiting for adimin to verify');
        window.location.href='bookings.php';
        </script>";
    }
    else{

        echo "<script>
        alert('booking failed');
        window.location.href='user_package.php';
        </script>";
    }

    }
?>
 <?php
if (isset($_POST["buypackagebtn"])) {
    $pid = $_POST["pid"];
    include("layout/DB.php");
    $sql = "SElECT * FROM package where pid='$pid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pname = $row['pname'];
        $p_start_destination = $row['p_start_destination'];
        $p_end_destination = $row['p_end_destination'];
        $days = $row['days'];
        $p_price = $row['p_price'];
        $p_image = $row['p_image'];
        $no_people = $row['no_people'];
      
    }
}
?>
      <div class="main">
    <form action="buy_package.php" class="user_package" method="post" >
        
        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" value="<?php echo $pname;?>" readonly>

        <label for="start_p">start destination:</label>
        <input type="text" id="start_p" name="start_p" value="<?php echo $p_start_destination;?>" readonly>
        <label for="end_p">final destination</label>
        <input type="text" name="end_p" id="end_p" value="<?php echo $p_end_destination;?>" readonly>

        <label for="price">Price</label>
        <input type="number" name="price" min="0" id="price" value="<?php echo $p_price;?>" readonly>

        <label for="days">Days</label>
        <input type="number" name="days" min="0" id="days" value="<?php echo $days;?>" readonly>
        <label for="people">no of_people</label>
        <input type="number" name="people" min="0" id="people" value="<?php echo $no_people;?>" readonly>
        <label for="date">Pick a date</label>
        <input type="date" name="date" id="date" value="" required>



        <input type="hidden" name="pid" value="<?php echo $pid ;?>" id="">

        <input type="submit" name="buy_package" value="booked">
    </form>
      </div>

      
      <?php
    include("layout/footer.php");
       ?>
   