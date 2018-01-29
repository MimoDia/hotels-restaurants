<?php
namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloNodeHistoryController extends ControllerBase {

 protected $database;
 protected $dateFormatter;

///////////////////////////////// INJECTION DES DEPENDANCES ///////////////////////////////////////////
// Preparation a la connexion a la BD et à la manipulation duformat de date
 public function __construct(Connection $database, DateFormatter $dateFormatter) {   // OU function __construct( $database,  $dateFormatter)
   $this->database = $database;
   $this->dateFormatter = $dateFormatter;
 }

 public static function create(ContainerInterface $container) { // create() pour preparer la connexion a la BD garce au container qui implement
 																// directement les services de drupal

   return new static(// appel au constructeur __construct(): appel a la methode  par referencement
     $container->get('database'), //  et comme on a proteger database, on ne peut recuperer ses element que grace a un getter
     $container->get('date.formatter')
   );
 }  
///////////////////////////////// FIN DE l'INJECTION DES DEPENDANCES ///////////////////////////////////////////

 public function revisionNode(NodeInterface $node) {
 	//  On pouvait faire directement la ligne suivante pour eviter d'utiliser les fonctions create() et __construct()
 	 // qui ne font que faire une injection de dependence. Donc on pouvait se passer de cette Injection de dependance  
 	// en utilisant un service drupal comme : $query =\Drupal::service('database')->select('hello_node_history', 'hnh')
 	// $query =\Drupal::service('database')->select('hello_node_history', 'hnh')


 		// Grace à l'injection des dependence je peut utiliser $this->database
   $query = $this->database->select('hello_node_history', 'hnh')
     ->fields('hnh', array('uid', 'update_time'))
     ->condition('nid', $node->id());

     // MESSAGE EN ENTETE: Ici le controlleur passe par la fonction de preprocess qui lui va pointer dans le fichier twig associée (hello_node_history.twg dans le quel on mettra: The node {{ node.label }} has been updated {{ count }})
    
     $count = $query->countQuery()->execute()->fetchField();
     $message= array(
      '#theme' => 'hello_node_history',
      '#node' => $node,
      '#count' => $count ,
      );

   ////////////////////////////  TABLEAU DES PAGINATIONS  //////////////////////////// 

    // extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit('5') permet de faire une pagination avec une limite
   $result = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit('5')->execute();
   $rows = array();
   $userStorage = $this->entityTypeManager()->getStorage('user');
   foreach ($result as $record) {
     $rows[] = array(
       $userStorage->load($record->uid)->toLink(),
       $this->dateFormatter->format($record->update_time),
     );
   }
   $table = array(
     '#theme'  => 'table',
     '#header' => array($this->t('Author'), $this->t('Update time')),
     '#rows'  => $rows,
   );

   // Pagination.
   $pager = array('#type' => 'pager');

   // On renvoie les 3 render arrays.
   return array(
     'message' => $message,
     'table' => $table,
     'pager' => $pager
   );
}
}