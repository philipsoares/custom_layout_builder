<?php
namespace Drupal\custom_layout_builder\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Alternate class for custom layouts builder.
 */
class CustomLayoutClass extends LayoutDefault implements PluginFormInterface {

/**
  * {@inheritdoc}
  */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $configuration = $this->getConfiguration();

    $form['columns'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Add columns width.*'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      '#description' => "Use | to separate each column width. <br> Example format: col-xs-6 col-sm-2 col-md-3|col-xs-6 col-sm-10 col-md-9",
      '#default_value' => isset($configuration['columns']) ? $configuration['columns'] : ''
    ];

    $form['container'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Check this option to set a fluid container.'),
      '#return_value' => '-fluid',
      '#default_value' => isset($configuration['container']) ? $configuration['container'] : ''
    );

    $form['css_class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Add a CSS class to create a wrapper on container.'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => "Example format: my-class",
      '#default_value' => isset($configuration['css_class']) ? $configuration['css_class'] : ''
    ];

    return $form;
  }

/**
  * {@inheritdoc}
  */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['columns'] = $form_state->getValue('columns');
    $this->configuration['container'] = empty($form_state->getValue('container')) ? '' : $form_state->getValue('container');
    $this->configuration['css_class'] = $form_state->getValue('css_class');
    parent::submitConfigurationForm($form, $form_state);
  }
}
