<h3><?php echo sprintf(__('Você solicitou uma alteração de senha em %s', true),  'Nome do site');?></h3>
<p><?php echo __('Seguindo o link abaixo você poderá alterar sua senha:', true);?></p>
<p><?php
$url = $this->Html->url(array('action'=>'recover_password', $md5_code), true);
echo $this->Html->link(__('Clique aqui para alterar sua senha'), $url);?>
</p>
<p><?php echo sprintf( __('O código de verificação: %s'), $md5_code);?></p>
<p><?php echo __("Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.", true);?></p>
<p><?php echo __('Respeitosamente,', true);?><br />
Nome do site</p>
