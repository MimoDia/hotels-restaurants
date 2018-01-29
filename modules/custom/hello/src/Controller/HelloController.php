<?php

namespace Drupal\hello\Controller;

// Chemin qui nous ramen vers le contrilleur de base
use Drupal\Core\Controller\ControllerBase;

use Symfony\Component\HttpFoundation\Response;


 class HelloController extends ControllerBase {

// // HelloController est une classe qui est creee garce au controlleur de base ControllerBase
//     public function content() {
//     	//kint(this->currentUser());
//     	//kint(\Drupal::currentUser());
//     	//kint(\Drupal::service('curent_user'));
//     	// this fait la référence à ControllerBase. C le ControllerBase quiest a l'origine currentUser()
    	// DEBUT CODE BON 1
//     	$message = $this->t(' You are on the Hello page. Your name is %username !' , 
//     		array(
//     			'%username' => $this->currentUser()->getAccountName() 
//     			));
//     	$build = array('#markup' => $message); 
//         return $build;
//  // on pouvait mettre aussi return $message       
// // getAccountName() equivalent getUsername() ou get 
// // $build = ['#markup' => $message)] equivau a array('#markup' => $message) ; 
//     }
 	// FIN CODE BON 1
 	    	// DEBUT CODE BON 2
 	public function content($param){
 		
 		$message= $this->t('You are on Hello page. And your name is %username ! et voici le paramètre %param',
 			array(
 			'%username' => $this->currentUser()->getAccountName(),
 			'%param' => $param
 				)); 
 			return array('#markup' => $message);
 	}
 			    	// DEBUT CODE BON 2

 	public function contenu(){
 		$response = new Response();
    	$response->setContent(json_encode([1, 2, 3, 4])); // S'affiche dans Inspection-> Network->all
    	$response->headers->set('Content-Type', 'application/json');
		return $response;
 	}	
}
// // getAccountName() equivalent getUsername() ou get 
// // $build = ['#markup' => $message)] equivau a array('#markup' => $message) ; 



