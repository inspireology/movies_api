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
            <?= $this->Html->link(__('Edit Api'), ['action' => 'edit', $api->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Api'), ['action' => 'delete', $api->id], ['confirm' => __('Are you sure you want to delete # {0}?', $api->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Api'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Api'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="api view content">
            <h3><?= h($api->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($api->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($api->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($api->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($api->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($api->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Enabled') ?></th>
                    <td><?= $api->is_enabled ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Api Key') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($api->api_key)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
