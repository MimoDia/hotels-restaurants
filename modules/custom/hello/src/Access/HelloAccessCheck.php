<?php
namespace Drupal\hello\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;


/**
 * Checks access for displaying configuration translation page.
 */
class HelloAccessCheck implements AccessCheckInterface {


  public function applies(Route $route){
    return NULL;
  }

  public function access(Route $route, Request $request= NULL, AccountInterface $account) {

       // return AccessResult::allowed();
    $nombre_heure_ecoulee = $route->getRequirement('_custom_access_hello'); // Drupal cherche le routeur qui fait le controle dacces dans la route
       // Si lutilisteur estanonyme, je lui refuse laccess

       if($account->isAnonymous()){
         return AccessResult::forbidden();
       }

       // si lheure actuelle moins le temps ecouler depuis la creation du compte est superieur
       if((time() - $account->getAccount()->created > $nombre_heure_ecoulee * 3600)){
          return AccessResult::allowed()->cachePerUser()->setCacheMaxAge(60);
       }
       return AccessResult::forbidden();
  }

}