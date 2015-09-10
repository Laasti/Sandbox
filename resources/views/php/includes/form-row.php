<div <?= $field->getContainerAttributes(); ?>>
<?php if ($field->hasLabel()): ?>
<label class="form-label" for="<?= $field->getId(); ?>"><?= $field->getLabel(); ?></label>
<?php elseif ($field->hasFakeLabel()): ?>
<span class="form-label"><?php echo $field->getLabel(); ?></span>
<?php endif; ?>
<?= $field->getControl(); ?>
<?php if ($field->getErrors()): ?>
<strong class="form-error"><?= $field->getError(); ?></strong>
<?php endif; ?>
</div>