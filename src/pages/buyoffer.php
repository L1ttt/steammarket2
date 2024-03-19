<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
require('db.php');
session_start();
$casename = $_POST["casename"];
$username = $_SESSION['username'];
$sql = "SELECT offer.idoffer, case.name, offer.price, offer.seller FROM asignment.offer
join asignment.case
on case.id = offer.caseid
Where case.name = '$casename'";
$queryResult = mysqli_query($con, $sql);
echo "<table width='100%'>";
echo "<tr><th>Case </th><th>Price</th><th>Seller</th><th></th></tr>";
$row = mysqli_fetch_row($queryResult);
while ($row) {
    echo "<tr><td>{$row[1]}</td>";
    echo "<td>{$row[2]}</td>";
    echo "<td>{$row[3]}</td>"; 
    echo "<td><form action='buyoffer-process.php' method='post'>
    <input type='hidden' value='{$row[0]}' name='idoffer'>
    <button type='submit'>BUY</button>
</form></td>";
    $row = mysqli_fetch_row($queryResult);
}
echo "</table>";
mysqli_free_result($queryResult);
mysqli_close($con);



    ?>
</body>
</html>
