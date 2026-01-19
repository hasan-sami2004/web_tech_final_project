<?php
$db = getConnection();
$sql = "
SELECT DATEDIFF(NOW(), borrow_date)-7 AS late_days
FROM borrowed_books
WHERE reader_id={$_SESSION['reader_id']}
AND return_date IS NULL
";
$result = $db->query($sql);

while($r=$result->fetch_assoc()){
  if($r['late_days']>0){
    echo "Late Fee: ".($r['late_days']*10)." Tk<br>";
  }
}
?>
