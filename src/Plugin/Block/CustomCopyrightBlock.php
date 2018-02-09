<?php

namespace Drupal\custom_copyright\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "custom_copyright_block",
 *   admin_label = @Translation("Custom Copy"),
 * )
 */

class CustomCopyrightBlock extends BlockBase {
	public function settings() {
		return $this->settings;
	}

	public function build() {
		// $config = $this->getConfiguration();
		// $year = $config['current'];
		$year = date('Y');
		$symbol = "&copy;";
		// $symbol = iconv("UTF-8", "ISO-8859-1", "©");
		// $symbol = chr(169);
		// ['#cache']['max-age'] = 0;
		$build = [];
		$markup = 'Copyright ' . $symbol . ' ' . $year;
		$build[text_content] = [
			'#markup' => $this->t($markup),
		];
		$build['#cache']['max-age'] = 0;
		return $build;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function blockAccess(AccountInterface $account) {
		return AccessResult::allowedIfHasPermission($account, 'access content');
	}

	/**
	 * {@inheritdoc}
	 */
	public function blockForm($form, FormStateInterface $form_state) {
		$form = parent::blockForm($form, $form_state);

		$config = $this->getConfiguration();

		/*$form['current'] = [
			'#title' => $this->t('Year'),
			'#type' => 'number',
			'#min' => '1990',
			'#max' => date('Y'),
			'#required' => TRUE,
			'#default_value' => $config['current'],
		];*/

		return $form;
	}

	/**
	 * {@inheritdoc}
	 */
	public function blockSubmit($form, FormStateInterface $form_state) {
		// $this->setConfigurationValue('current', $form_state->getValue('current'));
		/*$this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');*/
	}
} //class end.
