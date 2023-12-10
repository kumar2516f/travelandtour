<?php
include("a_layout/a_header.php");
include("a_layout/a_session.php");


?>

<div class="main">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: black;
        }

        #p_img {
            height: 50px;
            width: 50px;
        }
    </style>
<table>
    <tr>
        <th width="5%">SN</th>
        <th width="10%">Name</th>
        <th width="10%">Email</th>
        <th width="10%">Phone</th>
        <th width="15%">Package Name</th>
        <th width="15%">Start Destination</th>
        <th width="15%">Final Destination</th>
        <th width="5%">Days</th>
        <th width="5%">Price</th>
        <th width="10%">Booking Date</th>
        <th width="5%">No. of People</th>
    </tr>
    <?php
    include("a_layout/DB.php");
    $sqll = "SELECT u.uid, u.uname, u.uphone, u.email, 
           p.pid, p.pname, p.p_start_destination, p.end_destination, p.no_people, p.days, p.p_price, 
           b.b_date, b.bid, b.uid, b.pid  
    FROM bookings b
    INNER JOIN user u ON u.uid = b.uid
    INNER JOIN package p ON p.pid = b.pid";

    $result = $conn->query($sqll);
    if ($result) {
        $i = 1; // Initialize the serial number
        while ($row = $result->fetch_assoc()) {
            $uid = $row["uid"];
            $uname = $row["uname"];
            $uphone = $row["uphone"];
            $email = $row["email"];
            $bid = $row["bid"];
            $pid = $row["pid"];
            $b_date = $row["b_date"];

            $pname = $row["pname"];
            $p_start_destination = $row["p_start_destination"];
            $p_end_destination = $row["end_destination"];
            $no_people = $row["no_people"];
            $days = $row["days"];
            $p_price = $row["p_price"];

            echo "
                <tr>
                    <td>$i</td>
                    <td>$uname</td>
                    <td>$email</td>
                    <td>$uphone</td>
                    <td>$pname</td>
                    <td>$p_start_destination</td>
                    <td>$p_end_destination</td>
                    <td>$days</td>
                    <td>$p_price</td>
                    <td>$b_date</td>
                    <td>$no_people</td>
                </tr>
            ";

            $i++; // Increment the serial number
        }
    }
    ?>
</table>

    
    </table>
</div>

<?php
include("a_layout/a_footer.php");
?>
