<?php

/**
 * @file
 * Contains voyage.page.inc.
 *
 * Page callback for Voyage entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Voyage templates.
 *
 * Default template: voyage.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_voyage(array &$variables) {
  // Fetch Voyage Entity Object.
  $voyage = $variables['elements']['#voyage'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
