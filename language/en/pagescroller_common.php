<?php
/**
 *
 * @package phpBB Extension - Page Scroller
 * @copyright (c) Igor Peshkov (dark_diesel) <https://plus.google.com/+IgorPeshkov>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 * For full copyright and license information, contact with developer
 */


/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB')) {
  exit;
}

if (empty($lang) || !is_array($lang)) {
  $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
  // Settings page
  'ACP_PAGESCROLLER'          => 'Board Page Scroller',
  'ACP_PAGESCROLLER_SETTINGS' => 'Settings',

  'PAGESCROLLER'              => 'Page Scroller',
  'PAGESCROLLER_TITLE'        => 'View the Page Scroller',
  'PAGESCROLLER_VIEWONLINE'   => 'Viewing Page Scroller',
  'PAGESCROLLER_NOTIFICATION' => 'The Page Scroller have been updated. Click here to review them.',

  'PAGESCROLLER_UP'   => 'Up',
  'PAGESCROLLER_DOWN' => 'Down',
));