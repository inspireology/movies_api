<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Actor $actor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Actor'), ['action' => 'edit', $actor->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Actor'), ['action' => 'delete', $actor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $actor->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Actors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Actor'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="actors view content">
            <h3><?= h($actor->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name First') ?></th>
                    <td><?= h($actor->name_first) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name Last') ?></th>
                    <td><?= h($actor->name_last) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($actor->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($actor->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($actor->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Casts') ?></h4>
                <?php if (!empty($actor->casts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Actor Id') ?></th>
                            <th><?= __('Movie Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($actor->casts as $casts) : ?>
                        <tr>
                            <td><?= h($casts->id) ?></td>
                            <td><?= h($casts->actor_id) ?></td>
                            <td><?= h($casts->movie_id) ?></td>
                            <td><?= h($casts->created) ?></td>
                            <td><?= h($casts->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Casts', 'action' => 'view', $casts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Casts', 'action' => 'edit', $casts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Casts', 'action' => 'delete', $casts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casts->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
