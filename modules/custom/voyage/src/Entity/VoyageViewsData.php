<?php

namespace Drupal\voyage\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Voyage entities.
 */
class VoyageViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
