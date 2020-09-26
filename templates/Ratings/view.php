<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rating $rating
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rating'), ['action' => 'edit', $rating->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rating'), ['action' => 'delete', $rating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rating->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ratings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rating'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratings view content">
            <h3><?= h($rating->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($rating->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rating->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($rating->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Movies') ?></h4>
                <?php if (!empty($rating->movies)) : ?>
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
                        <?php foreach ($rating->movies as $movies) : ?>
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
