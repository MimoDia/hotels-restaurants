<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;

// Pour les permissions d'acces au droit
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
*@Block(
*id = "session_active",
*admin_label = @translation("Les sessions actives")
*)
*/
class SessionActive extends BlockBase {
 	public function build() {
 		 //kint(\Drupal::database()->select('sessions', 's')->countQuery()->execute()->fetchField());
 		
///////////////////////////////// METHODE 1 /////////////////////////////////
 	// 	$database=\Drupal::database(); // OU ENCORE $database=\Drupal::service('database');
 	// 	kint($database);

 	// 	$query= $database->select('sessions', 's');7
		// kint($query);

 	// 	$query= $query->countQuery();
		// kint($query);

 	// 	$statement= $query->execute();
		// kint($database);

 	// 	$resultat =$statement->fetchField()
		// kint($resultat);
 	//	return array(
 	//	 	'#markup' => $this->t('Session number: %number', array('%number' => $resultat ))
 	// 	 );

/////////////////////////////////////////// FIN METHODE 1  /////////////////////////////////

/////////////////////////////////METHODE 2/////////////////////////////////

		$numberSesssion = \Drupal::database()->select('sessions', 's')
			->countQuery()
			->execute()
			->fetchField();
 		
 		return array(
 			'#markup' => $this->t('Session number: %number', array('%number' => $numberSesssion )),
 			///////destruction des caches pour que lorsquon se deconnecter les caches sont detuites
 			// et le nombre de session de ne saccumulent pas apres chaque conneion doux les3 ligne suivantes et
 			// on a roujetr les deux hook dans le fichier hello.module (user_log et user_logout )
 			'#cache' => array(
 				'keys' => ['hello:session'],
 				'tags' => ['ma_session'],

 				)
 		 	);

	}
 		// GESTION DES PERMISSION  DACCES A  CE BLOC (SONT INTERDT DACCES LES ANONYMES)
		/////////// METHODE 1 (meilleure)  ////////////////
	protected function blockAccess(AccountInterface $account){
		return AccessResult::allowedIfHasPermission($account, 'mapermission blocksessionactive');// mapermission : id de ma permisson dans le fichier permissions.yml (racine)
	}
	/////////// FIN METHODE 1 ////////////////
	/////////// METHODE 2 ////////////////////

	// protected function blockAccess(AccountInterface $account) {
	// kint($account); //affiche: hasPermission($permission) 
	// kint($account->hasPermission('mapermission')) // Affiche TRUE;
	//	die();
	//  $notAnonymous = $account->hasPermission('hello permission');
	//  //kint($notAnonymous);
	//  if($notAnonymous == TRUE) {
	//    return AccessResult::allowed();
	//  }else{
	//    return AccessResult::neutral();
	//  }
	// }

	///////////  FIN METHODE 2 ////////////////

	
///////////////////////////////// TEST //// APPARITIN DANS LE BLOC
 		 // return array(
 			// '#markup' => $this->t('test')
 		 // 	);
 /////////////////////////////////		
 }