<?php foreach ($pagination as $page): ?>
<?php if ($page->isActive()): ?>
<b><?= $page->number(); ?></b>
<?php else: ?>
<a href="<?= $page->link(); ?>"><?= $page->number(); ?></a>
<?php endif; ?>
<?php endforeach; ?>
