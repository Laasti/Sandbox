<?php include('includes/head.php'); ?>
<?php if (!empty($success)): ?>
<?php foreach ($success as $message): ?>
<div class="success">
    <?= $message; ?>
</div>
<?php endforeach; ?>
<?php endif; ?>
<form action="<?= $form->getAction(); ?>" method="<?= $form->getMethod(); ?>" <?= $form->getFormAttributes(); ?>>
<?php foreach ($form->getFields() as $field): ?>
<?php include('includes/form-row.php'); ?>
<?php endforeach; ?>
<?php foreach ($form->getGroups() as $group): ?>
<?php include('includes/form-group.php'); ?>
<?php endforeach; ?>
</form>
<?php include('includes/body-end.php'); ?>