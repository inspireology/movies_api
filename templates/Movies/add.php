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
            <?= $this->Html->link(__('List Movies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="movies form content">
            <?= $this->Form->create($movie) ?>
            <fieldset>
                <legend><?= __('Add Movie') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('description');
                    echo $this->Form->control('duration');
                    echo $this->Form->control('rating_id', ['options' => $ratings, 'empty' => true]);
                    echo $this->Form->control('director_id', ['options' => $directors, 'empty' => true]);
                    echo $this->Form->control('genre_id', ['options' => $genres, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
