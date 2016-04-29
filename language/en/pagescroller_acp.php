<?php
/**
 *
 * @package phpBB Extension - Page Scroller
 * @copyright (c) Igor Peshkov (dark_diesel) <https://plus.google.com/+IgorPeshkov>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 * For full copyright and license information, contact with developer
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
  'ACP_PAGESCROLLER_SETTINGS' => 'Page Scroller Settings',
  'ACP_PAGESCROLLER_POSITION_SETTINGS' => 'Position Settings',
  'ACP_PAGESCROLLER_SETTING_SAVED' => 'Page Scroller Settings have been saved successfully!',

  'ACP_PAGESCROLLER_VERTICAL_POS'         => 'Vertical Position',
  'ACP_PAGESCROLLER_VERTICAL_POS_TOP'     => 'Top',
  'ACP_PAGESCROLLER_VERTICAL_POS_MIDDLE'  => 'Middle',
  'ACP_PAGESCROLLER_VERTICAL_POS_BOTTOM'  => 'Bottom',
  
  'ACP_PAGESCROLLER_HORIZONTAL_POS'       => 'Horizontal Position',
  'ACP_PAGESCROLLER_HORIZONTAL_POS_LEFT'  => 'Left',
  'ACP_PAGESCROLLER_HORIZONTAL_POS_RIGHT' => 'Right'
));