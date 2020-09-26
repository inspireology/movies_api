<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Genre $genre
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Genre'), ['action' => 'edit', $genre->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Genre'), ['action' => 'delete', $genre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $genre->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Genres'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Genre'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="genres view content">
            <h3><?= h($genre->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Display') ?></th>
                    <td><?= h($genre->name_display) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($genre->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Movies') ?></h4>
                <?php if (!empty($genre->movies)) : ?>
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
                        <?php foreach ($genre->movies as $movies) : ?>
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
