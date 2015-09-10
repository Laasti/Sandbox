<fieldset name="<?= $group->getName(); ?>" <?= $group->getAttributes(); ?>>
    <legend><?= $group->getLabel(); ?></legend>
    <?php foreach ($group->getFields() as $field): ?>
    <?php include('form-row.php'); ?>
    <?php endforeach; ?>
    <?php foreach ($group->getGroups() as $group): ?>
    <?php include('form-group.php'); ?>
    <?php endforeach; ?>
</fieldset>