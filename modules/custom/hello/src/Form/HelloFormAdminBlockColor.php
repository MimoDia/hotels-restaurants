<?php
namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
Use Drupal\Core\Config\ConfigFactoryInterface;

class HelloFormAdminBlockColor extends ConfigFormBase{

	public function getFormId(){
		return 'admin_form';
	}

	// Donner le droit de modifier certaines configurations
	protected function getEditableConfigNames(){
		return ['hello.config'];
	}

	// Construison le formulaire
	public function buildForm(array $form, FormStateInterface $form_state){
		$form =[]; // pas obligatoire ici: $form =[]
		$form['color'] = array(
       '#type' => 'select',
       '#title' => t('color'),
       '#description' => t('chose your color'),
       '#options' => array(
         'red' => $this->t('red'),
         'green' => $this->t('green'),
        'yellow' => $this->t('yellow'),
        '#default_value'=> $valeur,
     ),
       
     $form['validate'] = array(
       '#type' => 'submit',
       '#value' => t('Modify the color'),
     )

      );
	return parent::buildForm($form, $form_state);

	// Pour mettre à jour une valeur
	// $valeur= \Drupal::config('hello.config')->set($valeur, ‘valeur 1’);

	}

	public function submitForm( array &$form, FormStateInterface $form_state){
		// $valeur= \Drupal::config('hello.config')->get('color');
		//kint($valeur)
		$valeur = $form_state->getValue('color'); // affiche les differentes couleurs
		// on veut enregister la valeur de la couleur 
		$this->config('hello.config')->set('color', $valeur)->save();
		 
		////////// OU ENCORE //////////
		// kint($form_state->getValue()); //Affiche: 'color', 'validate' etc ...
		// $ // affiche les couleur
		// $maValeur =$this->config('hello.config')->set('color', $value)->save();

		return parent::submitForm($form, $form_state);
		
		// pour les caches
		\Drupal::entityTypeManager()->getViewBuilder('block')->resetCache();
		//die();
		
	}

}


