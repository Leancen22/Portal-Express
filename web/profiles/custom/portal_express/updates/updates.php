<?php

function portal_express_update_9001() {
  \Drupal::service('module_installer')->install([
    'isa_content_moderation'
  ]);
}

/**
 * Implements hook_update_9002().
 */
function portal_express_update_9002(&$sandbox)
{
  _portal_express_import_config([
    'isa_field_storage',
  ]);

  \Drupal::service('module_installer')->install([
    'isa_core'
  ]);
}

/**
 * Implements hook_update_9003().
 */
function portal_express_update_9003(&$sandbox)
{
  _portal_express_import_config([
    'isa_field_storage', 'isa_core'
  ]);

  \Drupal::service('module_installer')->install([
    'isa_core'
  ]);
}
