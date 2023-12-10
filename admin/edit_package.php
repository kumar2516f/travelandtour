<?php
if (isset($_POST["edit_package"])) {
    $pid = $_POST['pid'];

    $pname = $_POST['package_name'];
    $start_p = $_POST['start_p'];
    $end_p = $_POST['end_p'];
    $price = $_POST['price'];
    $days = $_POST['days'];
    $no_people = $_POST['people'];

    include('a_layout/DB.php');

    if ($_FILES["image"]["name"]) {
        $imageName = $_FILES["image"]["name"];
        $tmpName = $_FILES["image"]["tmp_name"];
        $uploadDir = "../uploads/";
        $uniqueName = time() . '_' . $imageName;
        $filePath = $uploadDir . $uniqueName;

        if (move_uploaded_file($tmpName, $filePath)) {
            $sql = "UPDATE package SET pname='$pname', p_start_destination='$start_p', p_end_destination='$end_p', days='$days', p_price='$price', p_image='$uniqueName', no_people='$no_people' WHERE pid='$pid'";
            $result = $conn->query($sql);

            if ($result) {
                echo "<script>
                    alert('Update successful');
                    window.location.href='package.php';
                </script>";
            } else {
                echo "<script>
                    alert('Update failed');
                    window.location.href='package.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('File upload failed');
                window.location.href='package.php';
            </script>";
        }
    } else {
        $sql = "UPDATE package SET pname='$pname', p_start_destination='$start_p', p_end_destination='$end_p', days='$days', p_price='$price', no_people='$no_people' WHERE pid='$pid'";
        $result = $conn->query($sql);

        if ($result) {
            echo "<script>
                alert('Update successful');
                window.location.href='package.php';
            </script>";
        } else {
            echo "<script>
                alert('Update failed');
                window.location.href='package.php';
            </script>";
        }
    }
}

?>

<?php
if (isset($_POST["editbtn"])) {
    $pid = $_POST["pid"];
    include("a_layout/DB.php");
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




<?php
include("a_layout/a_header.php");
include("a_layout/a_session.php");
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

<div class="main">
    <form action="edit_package.php" class="add_package" method="post" enctype="multipart/form-data">
        
        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" value="<?php echo $pname;?>" required>

        <label for="start_p">start destination:</label>
        <input type="text" id="start_p" name="start_p" value="<?php echo $p_start_destination;?>" required>
        <label for="end_p">final destination</label>
        <input type="text" name="end_p" id="end_p" value="<?php echo $p_end_destination;?>" required>

        <label for="price">Price</label>
        <input type="number" name="price" min="0" id="price" value="<?php echo $p_price;?>" required>

        <label for="days">Days</label>
        <input type="number" name="days" min="0" id="days" value="<?php echo $days;?>" required>
        <label for="people">no of_people</label>
        <input type="number" name="people" min="0" id="people" value="<?php echo $no_people;?>" required>

        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg">

        <input type="hidden" name="pid" value="<?php echo $pid ;?>" id="">

        <input type="submit" name="edit_package" value="edit">
    </form>
</div>


<?php
include("a_layout/a_footer.php");
?>