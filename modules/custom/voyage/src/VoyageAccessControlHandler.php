<?php

namespace Drupal\voyage;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Voyage entity.
 *
 * @see \Drupal\voyage\Entity\Voyage.
 */
class VoyageAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\voyage\Entity\VoyageInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished voyage entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published voyage entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit voyage entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete voyage entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add voyage entities');
  }

}
