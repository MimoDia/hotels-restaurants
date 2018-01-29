<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
*@Block(
*id = "hello_block",
*admin_label = @translation("Hello!")
*)
*/
class HelloBlock extends BlockBase {
 	public function build() {

		//kint(\Drupal::service('date.formatter'));
		// Le KINT AFFICHE : format($timestamp, $type = medium, $format = "", $timezone = NULL, $langcode = NULL)
		// time() qui est une fonction php, remplace $timestamp dansla commande suivante:

		//$heure_minute_seconde = \Drupal::service('date.formatter')->format(time(), $type =html_time);
		//$heure_minute_seconde = \Drupal::service('date.formatter')->format(time(), 'html_time');

		$this->currentUser= \Drupal::service('current_user');
		$this->dateFormatter= \Drupal::service('date.formatter');

// $this->currentUser (currentUser provent de la classe BlockBase)
// $this->currentUser->getAccountName() // currentUser (provenant de la class BlockBase) une classe qui a pour methode getAccountName()
 		$build = array(
 			'#markup' => $this->t('Welcome my dear ! The time is  %time', array(
 			'%username' => $this->currentUser->getAccountName(),
 			'%time' => $this->dateFormatter->format(REQUEST_TIME, 'costum', 'H:i: s\s'),
 					)
 			),

 			'#cache' => array(
 				'keys' => ['hello_block'],
 				'contexts' => ['user'],
 				'tags' => ['user:'.$this->currentUser->id()],
 				'max-age'=> '10',
 				)
 			); 
 		return $build;
		}

		// Construsire un bloc SessionActive qui affiche la liste de toutes les sessions active de mon site

 }