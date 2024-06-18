<?php
$id_campaign = $_GET['id_campaign'];

$query = "SELECT SUM(p.nominal_pembayaran) + c.dana_terkumpul_campaign AS total_amount 
           FROM pembayaran p 
           INNER JOIN campaign c ON p.id_campaign = c.id_campaign 
           WHERE p.id_campaign = $id_campaign";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $total_amount = $row['total_amount'];
        echo $total_amount;
    }
} else {
    echo "No results found";
}

mysqli_close($conn);
?>