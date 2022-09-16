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
 * Implements hook_update_9004 ().
 *
 * Update layout page and layout builder
 */
function portal_express_update_9004(&$sandbox)
{
  _portal_express_import_config([
    'isa_field_storage', 'isa_layout_page', 'isa_layout_builder'
  ]);

  \Drupal::service('module_installer')->install([
    'isa_layout_page', 'isa_layout_builder'
  ]);
}

/**
 * Implements hook_update_N().
 */
function portal_express_update_9005(&$sandbox)
{
  _portal_express_import_config([
    'isa_layout_page'
  ]);

  \Drupal::service('module_installer')->install([
    'isa_layout_page'
  ]);
}
