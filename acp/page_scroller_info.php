<?php
/**
 *
 * @package phpBB Extension - Page Scroller
 * @copyright (c) Igor Peshkov (dark_diesel) <https://plus.google.com/+IgorPeshkov>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 * For full copyright and license information, contact with developer
 */


namespace darkdiesel\pagescroller\acp;

class page_scroller_info {
  function module() {
    return array(
      'filename' => '\darkdiesel\pagescroller\acp\page_scroller_module',
      'title'    => 'ACP_PAGESCROLLER',
      'modes'    => array(
        'settings' => array(
          'title' => 'ACP_PAGESCROLLER_SETTINGS',
          'auth'  => 'ext_darkdiesel/pagescroller && acl_a_board',
          'cat'   => array('ACP_PAGESCROLLER')
        ),
      ),
    );
  }
}
