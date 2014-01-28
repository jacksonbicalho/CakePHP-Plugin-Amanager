<?php
/*
 * TbsHelper.php
 *
 * Copyright 2014 jackson Bicalho <jacksonbicalho@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */

class TbsHelper extends AppHelper {

  var $helpers = array('Session','Html', 'Form');

  public function __construct(View $view, $settings = array()) {
    parent::__construct($view, $settings);
  }

  /**
   * Gera um input para funcionar com o css do TwitterBootstrap
   *
   * in_group method
   *
   * @param string $fieldName
   * @param array $options
   * @return html
   */
	public function input($fieldName, $options = array()) {
    $options['class'] = isset($options['class'])?$options['class'] . ' form-control':'form-control';
    $options['error'] = array('attributes' => array('class' => 'alert alert-danger'));
    return $this->Form->input($fieldName, $options);
  }

  /**
   * Gera uma lista de checkbox usados para marcar registros
   * usados em relacionamentos de muitos para muitos para funcionar com o css do TwitterBootstrap
   *
   * habtm method
   *
   * @param string $fieldName
   * @param array $options
   * @return html
   */
	public function habtm($fieldName, $options = array()) {
    $options['error'] = array('attributes' => array('class' => 'alert alert-danger'));
    return $this->Form->input($fieldName, $options);
  }

  /**
   * Gera um botão do tipo submit para funcionar com o css do TwitterBootstrap
   *
   * submit method
   *
   * @param string $legend
   * @param array $options
   * @return html
   */
	public function submit($legend, $options = array()) {
    return $this->Html->div('input', $this->Form->button('<span class="glyphicon glyphicon-save"></span>  ' . $legend, array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) ) );
  }

}

?>
