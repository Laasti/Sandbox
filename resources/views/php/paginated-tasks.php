<?php include('includes/head.php'); ?>

<ol start="<?= $pagination->getOffset()+1; ?>">
<?php foreach ($tasks as $task): ?>
    <li><?= $task['name']; ?></li>
<?php endforeach; ?>
</ol>

<?php include('includes/pagination.php');
 include('includes/body-end.php');