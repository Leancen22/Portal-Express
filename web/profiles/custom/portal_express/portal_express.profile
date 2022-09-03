<?php

/**
 * @file
 * Enables modules and site configuration for a demo_umami site installation.
 */

use Drupal\contact\Entity\ContactForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function portal_express_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {
    $form['site_information']['site_name']['#default_value'] = 'Portal Express';
    $form['#submit'][] = 'portal_express_form_install_configure_submit';
  }
  
  /**
   * Submission handler to sync the contact.form.feedback recipient.
   */
  function portal_express_form_install_configure_submit($form, FormStateInterface $form_state) {
    $site_mail = $form_state->getValue('site_mail');
    ContactForm::load('feedback')->setRecipients([$site_mail])->trustData()->save();
  
    $password = $form_state->getValue('account')['pass'];
    portal_express_set_users_passwords($password);
  }
  
  /**
   * Sets the password of admin to be the password for all users.
   */
  function portal_express_set_users_passwords($admin_password) {
    // Collect the IDs of all users with roles editor or author.
    $ids = \Drupal::entityQuery('user')
      ->accessCheck(FALSE)
      ->condition('roles', ['author', 'editor'], 'IN')
      ->execute();
  
    $users = \Drupal::entityTypeManager()->getStorage('user')->loadMultiple($ids);
  
    foreach ($users as $user) {
      $user->setPassword($admin_password);
      $user->save();
    }
  }