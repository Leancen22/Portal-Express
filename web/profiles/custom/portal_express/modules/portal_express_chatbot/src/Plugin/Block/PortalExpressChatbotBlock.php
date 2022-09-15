<?php

namespace Drupal\isa_chatbot\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Provides a 'Chatbot' Block.
 *
 * @Block(
 *   id = "portal_express_chatbot_block",
 *   admin_label = @Translation("Portal Express Chatbot Block"),
 *   category = @Translation("Portal Express Chatbot"),
 * )
 */
class PortalExpressChatbotBlock extends BlockBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    // Main Section.
    $form['portal_express_chatbot'] = array(
        '#type' => 'fieldset',
        '#title' => $this->t('Chatbot Settings'),
      );

    $form['portal_express_chatbot']['host'] = [
      '#type' => 'url',
      '#title' => $this->t('Host'),
      '#default_value' => isset($config['host']) ? $config['host'] : '',
      '#required' => TRUE,
    ];

    $form['portal_express_chatbot']['bot_id'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Chatbot Identifier'),
        '#default_value' => isset($config['bot_id']) ? $config['bot_id'] : '',
        '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $this->configuration['host'] = $form_state->getValue(['portal_express_chatbot', 'host']);
    $this->configuration['bot_id'] = $form_state->getValue(['portal_express_chatbot', 'bot_id']);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = $this->getConfiguration();
    $host = substr($config['host'], -1) == "/" ? trim($config['host'], "/") : $config['host'];
    $bot_id = $config['bot_id'];
    $script_src = $host.'/assets/modules/channel-web/inject.js';

    $site_host = \Drupal::request()->getHttpHost();
    $module_path = \Drupal::service('module_handler')->getModule('portal_express_chatbot')->getPath();

    //Todo ver como se pone esto pen configuracion
    $extra_stylesheet = "https://${site_host}/${module_path}/assets/portal_express-botpress.css";

    $block = [
      '#theme' => 'portal_express_chatbot_block',
      '#host' => $host,
      '#bot_id' => $bot_id,
      '#src' => $script_src,
      '#extra_stylesheet' => $extra_stylesheet,
    ];

    return $block;
  }

}
