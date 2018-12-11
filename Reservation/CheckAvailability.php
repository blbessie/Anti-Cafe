<?php
include 'db_connection.php';
include 'db_basicoperation.php';

$connection = ConnectDB();
$table_name = "TimeTable";

$sql = "SELECT i, table1, table2 
FROM $table_name WHERE timeslot = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $_GET['time']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($index, $table1, $table2);
$stmt->fetch();
$stmt->close();

$newtime = $index+$_GET['dur']-1;

$sql = "SELECT table1, table2 
FROM $table_name WHERE i = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $newtime);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($futtable1, $futtable2);
$stmt->fetch();
$stmt->close();

if ($table1 === 'T' && $table2 === 'T'){
    echo "
        <div style='margin-top: 30px; margin-left: 200px;'>
            <p style='color: white;'>No seats available for this time slot.</p>
        </div>
        ";
}
else if ($futtable1 === 'T' && $futtable2 === 'T'){
    echo "
        <div style='margin-top: 30px; margin-left: 200px;'>
            <p style='color: white;'>No seats available for this time slot.</p>
        </div>
        ";
}
else {
    if ($table1 === 'F' && $futtable1 === 'F'){
        echo"
            <div class='form-check-inline' style='margin-left:200px; margin-top:50px;'>
                <label class='form-check-label'>
                <input type='radio' class='form-check-input radiocheck' name='seat' value='1'>Table 1
                </label>
            </div>";
    }
    if ($table2 === 'F' && $futtable2 === 'F'){
        echo"<div class='form-check-inline' style='margin-left:400px; margin-top:50px;'>
            <label class='form-check-label'>
            <input type='radio' class='form-check-input radiocheck' name='seat' value='2'>Table 2
            </label>
        </div>";
    }

}
