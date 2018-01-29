<?php

namespace Drupal\voyage\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Voyage entities.
 *
 * @ingroup voyage
 */
interface VoyageInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Voyage name.
   *
   * @return string
   *   Name of the Voyage.
   */
  public function getName();

  /**
   * Sets the Voyage name.
   *
   * @param string $name
   *   The Voyage name.
   *
   * @return \Drupal\voyage\Entity\VoyageInterface
   *   The called Voyage entity.
   */
  public function setName($name);

  /**
   * Gets the Voyage creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Voyage.
   */
  public function getCreatedTime();

  /**
   * Sets the Voyage creation timestamp.
   *
   * @param int $timestamp
   *   The Voyage creation timestamp.
   *
   * @return \Drupal\voyage\Entity\VoyageInterface
   *   The called Voyage entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Voyage published status indicator.
   *
   * Unpublished Voyage are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Voyage is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Voyage.
   *
   * @param bool $published
   *   TRUE to set this Voyage to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\voyage\Entity\VoyageInterface
   *   The called Voyage entity.
   */
  public function setPublished($published);

}
