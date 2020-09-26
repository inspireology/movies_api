<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Director[]|\Cake\Collection\CollectionInterface $directors
 */
?>
<div class="directors index content">
    <?= $this->Html->link(__('New Director'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Directors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_first') ?></th>
                    <th><?= $this->Paginator->sort('name_last') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($directors as $director): ?>
                <tr>
                    <td><?= $this->Number->format($director->id) ?></td>
                    <td><?= h($director->name_first) ?></td>
                    <td><?= h($director->name_last) ?></td>
                    <td><?= h($director->created) ?></td>
                    <td><?= h($director->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $director->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $director->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $director->id], ['confirm' => __('Are you sure you want to delete # {0}?', $director->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
