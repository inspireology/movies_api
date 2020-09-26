<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Director $director
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Director'), ['action' => 'edit', $director->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Director'), ['action' => 'delete', $director->id], ['confirm' => __('Are you sure you want to delete # {0}?', $director->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Directors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Director'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="directors view content">
            <h3><?= h($director->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name First') ?></th>
                    <td><?= h($director->name_first) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name Last') ?></th>
                    <td><?= h($director->name_last) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($director->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($director->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($director->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Movies') ?></h4>
                <?php if (!empty($director->movies)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Duration') ?></th>
                            <th><?= __('Rating Id') ?></th>
                            <th><?= __('Director Id') ?></th>
                            <th><?= __('Genre Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($director->movies as $movies) : ?>
                        <tr>
                            <td><?= h($movies->id) ?></td>
                            <td><?= h($movies->title) ?></td>
                            <td><?= h($movies->description) ?></td>
                            <td><?= h($movies->duration) ?></td>
                            <td><?= h($movies->rating_id) ?></td>
                            <td><?= h($movies->director_id) ?></td>
                            <td><?= h($movies->genre_id) ?></td>
                            <td><?= h($movies->created) ?></td>
                            <td><?= h($movies->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Movies', 'action' => 'view', $movies->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Movies', 'action' => 'edit', $movies->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Movies', 'action' => 'delete', $movies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movies->id)]) ?>
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
