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

$buyer = $_SESSION["username"];

$idoffer = $_POST["idoffer"];
$sql = "SELECT price , seller FROM asignment.offer
        WHERE idoffer = '$idoffer';";
$row = mysqli_fetch_row(mysqli_query($con, $sql));
$price = (int)$row[0];
$row = mysqli_fetch_row(mysqli_query($con, $sql));
$seller = $row[1];
$sql = "SELECT credit FROM asignment.login
        WHERE username = '$buyer';";
        $row = mysqli_fetch_row(mysqli_query($con, $sql));
$buyercredit = (int)$row[0];
$sql = "SELECT credit FROM asignment.login
        WHERE username = '$seller';";
        $row = mysqli_fetch_row(mysqli_query($con, $sql));
$sellercredit = (int)$row[0];
$sql = "SELECT caseid FROM asignment.offer
        WHERE idoffer = $idoffer;";
        $row = mysqli_fetch_row(mysqli_query($con, $sql));
$caseid = $row[0];
//check credit
if($buyercredit >= $price){
$sql = "UPDATE `asignment`.`offer` SET `buyer` = '$buyer'
        WHERE idoffer = '$idoffer'; ";
$queryResult = mysqli_query($con, $sql);
$buyeraftercredit = $buyercredit - $price;
$sql = "UPDATE `asignment`.`login` SET `credit` = '$buyeraftercredit' WHERE (`username` = '$buyer');";
$queryResult = mysqli_query($con, $sql);
$selleraftercredit = $sellercredit + $price;
$sql = "UPDATE `asignment`.`login` SET `credit` = '$selleraftercredit' WHERE (`username` = '$seller');";
$queryResult = mysqli_query($con, $sql);
$sql = "UPDATE `asignment`.`case` SET `owner` = '$buyer' WHERE id = $caseid;";
$queryResult = mysqli_query($con, $sql);
echo "Congratuation, the transaction has been sucessed.";
}
else{
    echo "You do not have enough credit.";
}
    ?>
</body>
</html>