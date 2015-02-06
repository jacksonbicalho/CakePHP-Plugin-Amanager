<?php
    $error = array('attributes' => array('class' => 'alert alert-danger'));
    $required = false;
    $password_options = array(
        'value'=>null,
        'label'=>__d('amanager', 'Senha'),
        'class'=>'form-control',
        'error'=>$error,
        'required'=> $required,
    );
    $password2_options = array(
        'value'=>null,
        'label'=>__d('amanager', 'Repita a senha'),
        'class'=>'form-control',
        'error'=>$error,
        'required'=> $required,
        'type'=> 'password',
    );
    if(!$required){
        $password_options['value'] = '';
        $password2_options['value'] = '';
    }
?>
<div class="users form col-xs-12">
    <?php echo $this->Form->create('User', array('role'=>'form')); ?>
        <div class="form-group">
            <div class="page-header">
                <h2 id="forms"><?php echo __d('amanager', 'Manager User'); ?></h2>
            </div>
            <?php
                echo $this->Form->input('username',
                    array(
                        'label'=>__d('amanager', 'Nome de usuário'),
                        'class'=>'form-control',
                        'error'=>$error
                    )
                );
                echo $this->Form->input('password', $password_options);
                echo $this->Form->input('password2', $password2_options);
                echo $this->Form->input('email',
                    array(
                        'label'=>__d('amanager', 'E-mail'),
                        'class'=>'form-control',
                        'error'=>$error,
                        'required'=> $required
                    )
                );
            ?>
            <?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __d('amanager', 'Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
        </div>
    <?php echo $this->Form->end(); ?>
</div>
