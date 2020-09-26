<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Api $api
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $api->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $api->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Api'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="api form content">
            <?= $this->Form->create($api) ?>
            <fieldset>
                <legend><?= __('Edit Api') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('api_key');
                    echo $this->Form->control('is_enabled');
                    echo $this->Form->control('email');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
