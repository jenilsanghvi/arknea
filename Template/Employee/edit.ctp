<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employee->employee_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employee->employee_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Employee'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="employee form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Edit Employee') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('address');
            echo $this->Form->control('email');
            echo $this->Form->control('phone', ['label' => 'Phone Number','type' => 'number']);
            echo $this->Form->control('dob', [ 'label' => 'Date of birth',
                'minYear' => date('Y') - 70,
                'maxYear' => date('Y')
              ]);
              echo $this->Form->control('image',['label' => 'Employee Image','type' => 'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
