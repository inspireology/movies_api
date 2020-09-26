<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cast $cast
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cast'), ['action' => 'edit', $cast->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cast'), ['action' => 'delete', $cast->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cast->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Casts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cast'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="casts view content">
            <h3><?= h($cast->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Actor') ?></th>
                    <td><?= $cast->has('actor') ? $this->Html->link($cast->actor->id, ['controller' => 'Actors', 'action' => 'view', $cast->actor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Movie') ?></th>
                    <td><?= $cast->has('movie') ? $this->Html->link($cast->movie->title, ['controller' => 'Movies', 'action' => 'view', $cast->movie->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cast->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($cast->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($cast->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
