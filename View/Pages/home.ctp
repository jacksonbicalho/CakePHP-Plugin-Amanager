<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>

<div id="content">

	<div class="coluna_direita">
		<div id="box_login">
			<div class="titulo_widget">
				<h2><?php echo __('Área do aluno', true);?></h2>
			</div>
			<div class="meio">
				<?php echo $this->element("form_login"); ?>
			</div>
		</div>
	</div>

	<div class="bloco_esquerda">
		<div class="titulo_esquerda">
			<h2>Cursos disponíveis</h2>
		</div>

		<div class="meio">
			<div class="topico">
				<h3>NORMA REGULAMENTADORA Nº 10</h3>
				<p>Atender a Lei</p>
				<?php echo $this->Html->link($this->Html->image('botao_saiba_mais.png', array('alt' => 'CakePHP')), array('controller'=>'courses', 'action'=>'view', 'norma-regulamentadora-n-10', 'admin'=>false),array('title'=>'Saiba mais', 'escape'=>false)) ?>
				<div class="clr"></div>
			</div>
		</div>
	</div>


</div>
<div class="clr"></div>
