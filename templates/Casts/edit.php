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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cast->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cast->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Casts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="casts form content">
            <?= $this->Form->create($cast) ?>
            <fieldset>
                <legend><?= __('Edit Cast') ?></legend>
                <?php
                    echo $this->Form->control('actor_id', ['options' => $actors]);
                    echo $this->Form->control('movie_id', ['options' => $movies]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
