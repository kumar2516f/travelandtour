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
        margin-bottom: 75px;
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
    if(isset($_POST["add_package"])) {
        $pname = $_POST['package_name'];
        $start_p = $_POST['start_p'];
        $end_p = $_POST['end_p'];
        $price = $_POST['price'];
        $days = $_POST['days'];
        $people=$_POST['people'];

        // File handling
        $imageName = $_FILES["image"]["name"]; //image name
        $tmpName = $_FILES["image"]["tmp_name"];
        $uploadDir = "../uploads/";
        $uniqueName = time() . '_' . $imageName;
        $filePath = $uploadDir . $uniqueName;

        if(move_uploaded_file($tmpName, $filePath)) {
            // File upload successful

            include('a_layout/DB.php');
            $sql = "INSERT INTO package (pid, pname, p_start_destination, p_end_destination, days, p_price, no_people, p_image) VALUES (NULL, '$pname', '$start_p', '$end_p', '$days', '$price', '$people', '$uniqueName')";
            $result = $conn->query($sql);

            if($result) {
                echo "<script>
                    alert('add successful');
                    window.location.href='package.php';
                </script>";
            } else {
                echo "<script>
                    alert('add failed');
                    window.location.href='package.php';
                </script>";
            }
        } else {
            // File upload failed
            echo "<script>
                alert('File upload failed');
                window.location.href='package.php';
            </script>";
        }
    }
?>

<div class="main">
    <form action="add_package.php" class="add_package" method="post" enctype="multipart/form-data">
        <h2>Package</h2>
        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" required>

        <label for="start_p">start destination:</label>
        <input type="text" id="start_p" name="start_p" required>
        <label for="end_p">final destination</label>
        <input type="text" name="end_p" id="end_p" required>

        <label for="price">Price</label>
        <input type="number" name="price" min="1" id="price" required>

        <label for="days">Days</label>
        <input type="number" name="days" min="1" id="days" required>
        <label for="people">people capacity(vechile) </label>
        <input type="number" name="people" min="1" id="people" required>

        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg" required>

        <input type="submit" name="add_package" value="ADD">  
    </form>
</div>

<?php
    include("a_layout/a_footer.php");
?>
