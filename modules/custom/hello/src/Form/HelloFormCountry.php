<?php
namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\State\StateInterface;

use SameerShelavale\PhpCountriesArray\CountriesArray;

class HelloFormCountry extends FormBase {

   // renvoyer des identifiant
   public function getFormID() {
     return 'country';
   }

    // Construison le formulaire
  public function buildForm(array $form, FormStateInterface $form_state){

        $countries = CountriesArray::getFromContinent( 'alpha2', 'name', 'Africa' );
    $form['country'] = array(
       '#type' => 'select',
       '#title' => t('Country list'),
       '#description' => t('chose a country'),
       '#options' => array(
        '#country' => $countries),
       );
     $form['validate'] = array(
       '#type' => 'submit',
       '#value' => t('Send your request'),
      );
  return $form;

  }


   // La methode qui permet de faire toutes les vérification possibles
   public function validateForm(array &$form, FormStateInterface $form_state) {
     // Validation is optional.
     }


     public function submitForm(array &$form, FormStateInterface $form_state) {
     // Récupère la valeur des champs.

       }


    // protected function blockAccess(AccountInterface $account){
    //  return AccessResult::allowedIfHasPermission($account, 'access hello');// mapermission : id de ma permisson dans le fichier permissions.yml (racine)
    // }

}