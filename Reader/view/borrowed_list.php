<?php while($row = $data->fetch_assoc()){ ?>
<p>
 <?= $row['title'] ?> |
 Borrowed: <?= $row['borrow_date'] ?> |
 Returned: <?= $row['return_date'] ?? 'Not Yet' ?>
</p>
<?php } ?>
