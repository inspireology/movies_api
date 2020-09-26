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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $director->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $director->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Directors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="directors form content">
            <?= $this->Form->create($director) ?>
            <fieldset>
                <legend><?= __('Edit Director') ?></legend>
                <?php
                    echo $this->Form->control('name_first');
                    echo $this->Form->control('name_last');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
