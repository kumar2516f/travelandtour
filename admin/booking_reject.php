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

        th,
        td {
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

        /* Basic button styles */
        .button {
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border: 1px solid #4CAF50;
            /* Button border color */
            color: #ffffff;
            /* Button text color */
            background-color: #4CAF50;
            /* Button background color */
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Button hover styles */
        .button:hover {
            background-color: #45a049;
            /* Change background color on hover */
            border-color: #45a049;
            /* Change border color on hover */
        }
    </style>

    <a href="booking_approved.php" class="button">Approved</a>
    <a href="booking_reject.php" class="button">Rejected</a>




    <table>
        <tr>
            <th colspan="12" style="text-align:center; font-size:30px">
                Rejected Booking
            </th>
        </tr>
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
            <th width="5%">Status</th>

        </tr>
        <?php
        include("a_layout/DB.php");
        $sqll = "SELECT u.uid, u.uname, u.uphone, u.email, 
                   p.pid, p.pname, p.p_start_destination, p.p_end_destination, p.no_people, p.days, p.p_price, 
                   b.b_date, b.bid, b.uid, b.pid , b.status 
                FROM bookings b
                INNER JOIN user u ON u.uid = b.uid
                INNER JOIN package p ON p.pid = b.pid
                where b.status='reject'
                ORDER BY b.b_date DESC
                ";

        $result = $conn->query($sqll);
        if ($result) {
            $i = 1; // Initialize the serial number
            while ($row = $result->fetch_assoc()) {
                // Fetching data from the query result
                $uid = $row["uid"];
                $bid = $row["bid"];
                $pid = $row["pid"];

                $uname = $row["uname"];
                $uphone = $row["uphone"];
                $email = $row["email"];

                $b_date = $row["b_date"];
                $status = $row["status"];

                $pname = $row["pname"];
                $p_start_destination = $row["p_start_destination"];
                $p_end_destination = $row["p_end_destination"]; // Corrected column name here
                $no_people = $row["no_people"];
                $days = $row["days"];
                $p_price = $row["p_price"];

                // Outputting table rows with fetched data
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
                        <td>$status</td>
                        
                    </tr>
                ";

                $i++; // Increment the serial number
            }
        }
        ?>
    </table>
</div>

<?php
include("a_layout/a_footer.php");
?>