<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Movie $movie
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Movie'), ['action' => 'edit', $movie->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Movie'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Movies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Movie'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="movies view content">
            <h3><?= h($movie->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($movie->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rating') ?></th>
                    <td><?= $movie->has('rating') ? $this->Html->link($movie->rating->name, ['controller' => 'Ratings', 'action' => 'view', $movie->rating->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Director') ?></th>
                    <td><?= $movie->has('director') ? $this->Html->link($movie->director->id, ['controller' => 'Directors', 'action' => 'view', $movie->director->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Genre') ?></th>
                    <td><?= $movie->has('genre') ? $this->Html->link($movie->genre->id, ['controller' => 'Genres', 'action' => 'view', $movie->genre->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($movie->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= $this->Number->format($movie->duration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($movie->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($movie->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($movie->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Casts') ?></h4>
                <?php if (!empty($movie->casts)) : ?>
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
                        <?php foreach ($movie->casts as $casts) : ?>
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
            <div class="related">
                <h4><?= __('Related Favorites') ?></h4>
                <?php if (!empty($movie->favorites)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Movie Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($movie->favorites as $favorites) : ?>
                        <tr>
                            <td><?= h($favorites->id) ?></td>
                            <td><?= h($favorites->user_id) ?></td>
                            <td><?= h($favorites->movie_id) ?></td>
                            <td><?= h($favorites->created) ?></td>
                            <td><?= h($favorites->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Favorites', 'action' => 'view', $favorites->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Favorites', 'action' => 'edit', $favorites->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Favorites', 'action' => 'delete', $favorites->id], ['confirm' => __('Are you sure you want to delete # {0}?', $favorites->id)]) ?>
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
