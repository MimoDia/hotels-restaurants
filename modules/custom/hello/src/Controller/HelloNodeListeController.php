<?php

namespace Drupal\hello\Controller;

// Chemin qui nous ramen vers le contrilleur de base
use Drupal\Core\Controller\ControllerBase;

 class HelloNodeListeController extends ControllerBase {

 	public function nodeListe($nodetype) {

 		//kint(\Drupal::entityTypeManager());

 		// $storage = \Drupal::entityTypeManager()->getStorage($entity_type); // =$entity_type = node
 		$storage = \Drupal::entityTypeManager()->getStorage('node');
 		//kint($storage);

 		$id = \Drupal::entityQuery('node')->pager('10'); // onpouvait directement directement: getQery()
 		// Ou on met directement la ligne suivante pour recuperrer le l'id sans passer par le service: Drupal::entityQuery('node')
 		// $id = \Drupal::entityTypeManager()->getStorage('node')->getQery()->pager('10');

 		 // Si on a un argument dans l’URL, on ne cible que les noeuds correspondants.
 		if($nodetype){
    		$id->condition('type', $nodetype);
 		 }

 		$id= $id->execute();
 		// kint($id); renvoie la valeur de chaqye noeud (node)
		$entities = $storage->loadMultiple($id); // cest un tabelau ARRAY que cela me donne, il me faut faire une boucle foreach
		 //kint($entities);

		foreach($entities as $value){
				//$titre = $value->getTitle();
				$titre[] = $value->toLink();
		}
		// $node_title = $entities->getTitle();
		// kint($node_title);

   			$list = array(
      	 		'#theme' => 'item_list',
       	    	'#items' => $titre,
    		);

  		 $pager = array('#type' => 'pager',);

  		 return array($list, $pager);


   		// $items = ['pim', 'pam', 'poum'];

   		// $list = array(
     //  	 '#theme' => 'item_list',
     //   	'#items' => $items,
    	//  );
  		 // return $list;


 
///////////////////// METHODE 2 PROF ////////////////////////////////////
	//  public function content($nodetype) {
	//   $query = $this->entityTypeManager()->getStorage('node')->getQuery(); // $this est permis grace au controller de base ControllerBase
	//   // $query = $this->entityQuery(‘node’);
	//   // Si on a un argument dans l’URL, on ne cible que les noeuds correspondants.
	//   if ($nodetype) {
	//     $query->condition('type', $nodetype);
	//   }
	//   // On construit une requête paginée.
	//   $nids = $query->execute();
	//   // Charge les noeuds correspondants au résultat de la requête.
	//   $nodes = $this->entityTypeManager()->getStorage(‘node’)->loadMultiple($nids);

	//   // Construit un tableau de liens vers les noeuds.
	//   $items = array();
	//   foreach ($nodes as $node) {
	//     $items[] = $node->toLink();
	//   }
	//   $list = array(
	//     ‘#theme’ => ‘item_list’,
	//     ‘#items’ => $items,
	//   );
	//   return $list;
	// }
///////////////////// FIN METHODE 2 PROF ////////////////////////////////////
 }
 			    
}

