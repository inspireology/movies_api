<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cast[]|\Cake\Collection\CollectionInterface $casts
 */
?>
<div class="casts index content">
    <?= $this->Html->link(__('New Cast'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Casts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('actor_id') ?></th>
                    <th><?= $this->Paginator->sort('movie_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($casts as $cast): ?>
                <tr>
                    <td><?= $this->Number->format($cast->id) ?></td>
                    <td><?= $cast->has('actor') ? $this->Html->link($cast->actor->id, ['controller' => 'Actors', 'action' => 'view', $cast->actor->id]) : '' ?></td>
                    <td><?= $cast->has('movie') ? $this->Html->link($cast->movie->title, ['controller' => 'Movies', 'action' => 'view', $cast->movie->id]) : '' ?></td>
                    <td><?= h($cast->created) ?></td>
                    <td><?= h($cast->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $cast->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cast->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cast->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cast->id)]) ?>
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
