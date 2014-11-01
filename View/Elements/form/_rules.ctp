<div class="rules form col-xs-12">
    <?php echo $this->Form->create('Rule', array('role'=>'form')); ?>
        <div class="page-header">
            <h2 id="forms"><?php echo __d('amanager', 'Manager User'); ?></h2>
        </div>

        <div id="rules_list">
            <h3><?php echo __d('amanager', 'Rules list', true)?></h3>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Regra</th>
                    <th>Permitir?</th>
                    <th>Delete</th>
                </tr>
                <tbody id="sortable">
                    <tr id="Module_<?php echo "ALTERAR"; ?>"></tr>
                        <?php if(isset($actions_salvas)):
                            foreach( $actions_salvas as $k => $action): ?>
                                <tr id="action_<?php echo $k; ?>">
                                    <td>
                                        <?php
                                        if(isset($action['id'])){
                                            echo $this->Form->hidden("Action.{$k}.id", array('label'=>false, 'value'=>$action['id']));
                                        }
                                        echo $this->Form->input("Action.{$k}.alias", array('class'=>'form-control', 'label'=>false, 'value'=>$action['alias']));
                                        ?>
                                    </td>
                                    <td><?php  echo $this->Form->checkbox("Action.{$k}.alow", array('hiddenField' => false)  ); ?></td>
                                    <td class="actions">
                                        <?php echo $this->Html->Link(__('Delete'), "javascript:removeTr({$k})", array('class' => "btn btn-danger"), __('Are you sure you want to delete this action: %s?', $action['alias'])); ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        endif;?>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="page-header">
                <h2 id="forms"><?php echo __d('amanager', 'Add Rule'); ?></h2>
            </div>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name', array('class'=>'form-control'));
            echo $this->Form->input('Group', array('label' => 'Grupos', 'type' => 'select', 'multiple' => 'checkbox'));
            echo $this->Form->input('plugin', array('empty'=> 'Selecione se for para Plugin', 'class'=>'form-control'));
            $this->Js->get('#RulePlugin');
            $this->Js->get('#RulePlugin')->event(
                'change', $this->Js->request(
                    array('action' => 'get_controlles_plugins'),
                    array(
                        'update' => '#RuleController',
                        'dataExpression' => true,
                        'method' => 'post',
                        'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true)),
                        'complete'=>'$("#RuleController").trigger("change");',
                    )
                )
            );

            echo $this->Form->input('controller', array('class'=>'form-control'));
            $this->Js->get('#RuleController');
            $this->Js->get('#RuleController')->event(
                'change', $this->Js->request(
                array('action' => 'get_methods_controlles'),
                    array(
                        'update' => '#RuleAction',
                        'dataExpression' => true,
                        'method' => 'post',
                        'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
                    )
                )
            );

            echo $this->Html->div('display_none',
                $this->Form->input('select_all', array('type'=>'checkbox', 'id'=>'select_all', 'div'=>'input checkbox select_all')) .
                $this->Html->Link(__d('amanager', "send all selected"), "javascript:all_actions()", array('id'=>'all_actions', 'class' => "btn btn btn-success all_actions", 'escape'=>false))
            );

            echo $this->Form->input('action', array('multiple'=>false, 'size'=>10, 'class'=>'form-control'));
            $this->Js->get('#RuleAction');
            $this->Js->get('#RuleAction')->event(
                'dblclick', $this->Js->request(
                    array('action' => 'update_rules_list'),
                    array(
                        'update' => '#sortable',
                        'dataExpression' => true,
                        'method' => 'post',
                        'data' => $this->Js->serializeForm(array('isForm' => false, 'inline' => true))
                    )
                )
            );

            $this->Js->get('#select_all');
            $this->Js->event(
                'click',
                '$("#RuleAction option").prop("selected", $(this).is(":checked"));',
                array('stop' => false)
            );

            $this->Js->get('#all_actions');
            $this->Js->get('#all_actions')->event(
                'click', $this->Js->request(
                    array('action' => 'update_rules_list'),
                    array(
                        'complete' => '$("#RuleAction option").prop("selected", false);$("#select_all").prop("checked", false);',
                        'update' => '#sortable',
                        'dataExpression' => true,
                        'method' => 'post',
                        'data' => $this->Js->serializeForm(array('isForm' => false, 'inline' => true))
                    )
                )
            );
            ?>
        </div>

        <?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __d('amanager', 'Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
    <?php echo $this->Form->end(); ?>
</div>

<?php
    echo $this->Html->scriptBlock(
        '
            function removeTr(id){
                $("#action_" + id).fadeOut(500, function() {
                    $(this).remove();
                    return false;
                });
            }
        ',
        array('inline' => false)
    );
?>
