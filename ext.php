<?php
/**
 *
 * @package phpBB Extension - Page Scroller
 * @copyright (c) Igor Peshkov (dark_diesel) <https://plus.google.com/+IgorPeshkov>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 * For full copyright and license information, contact with developer
 */



namespace darkdiesel\pagescroller;

/**
* Extension class for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
	/** @var string Require 3.1.2 due to updated INCLUDECSS syntax */
	const PHPBB_VERSION = '3.1.2';
	const DARKDIESEL_PAGESCROLLER_ROOT_PATH = 'ext/darkdiesel/pagescroller/';

	/**
	 * Enable extension if phpBB minimum version requirement is met
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], self::PHPBB_VERSION, '>=');
	}
}
