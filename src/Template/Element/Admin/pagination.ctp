<!-- Start Results Bar -->
<div class="paging">
	<div class="totalresults">
		<strong><?= $this->Paginator->counter('Showing {{start}} - {{end}}</strong> (of {{count}})'); ?></strong>
	</div>
	<div class="pagenumber">
		<ul class="pagination">
			<?php if ($this->Paginator->hasPrev()) : ?>
				<li><?= $this->Paginator->first('<< Start '); ?></li>
				<li><?= $this->Paginator->prev('<< Prev '); ?></li>
			<?php endif; ?>

			<?php if (is_string($this->Paginator->numbers())): ?>
				<?= $this->Paginator->numbers(array('separator' => '',
														   'before' => '',
														   'after' => '',
														   'tag' => 'li',
														   'currentTag' => 'span',
														   'currentClass' => 'active'));?>
			<?php endif; ?>

			<?php if ($this->Paginator->hasNext()): ?>
				<li><?= $this->Paginator->next(' Next >>'); ?></li>
				<li><?= $this->Paginator->last(' End >>'); ?></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<!-- End Results Bar -->