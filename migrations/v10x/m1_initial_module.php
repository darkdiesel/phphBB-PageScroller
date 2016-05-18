<?php
/**
 *
 * @package phpBB Extension - Page Scroller
 * @copyright (c) Igor Peshkov (dark_diesel) <https://plus.google.com/+IgorPeshkov>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 * For full copyright and license information, contact with developer
 */

namespace darkdiesel\pagescroller\migrations\v10x;

/**
 * Migration stage 1: Initial module
 */
class m1_initial_module extends \phpbb\db\migration\migration {
  /**
   * Assign migration file dependencies for this migration
   *
   * @return array Array of migration files
   * @static
   * @access public
   */
  static public function depends_on() {
    return array('\phpbb\db\migration\data\v31x\v312');
  }

  /**
   * Add or update data in the database
   *
   * @return array Array of table data
   * @access public
   */
  public function update_data() {
    return array(
      array('config.add', array('darkdiesel_pagescroller_horizontal_pos', 'right')),
      array('config.add', array('darkdiesel_pagescroller_vertical_pos', 'bottom')),
      array('config.add', array('darkdiesel_pagescroller_scroll_up_speed', '800')),
      array('config.add', array('darkdiesel_pagescroller_scroll_down_speed', '800')),
      array('config.add', array('darkdiesel_pagescroller_animation_hideshow_enable', 'false')),
      array('config.add', array('darkdiesel_pagescroller_animation_hideshow_duration_show', '200')),
      array('config.add', array('darkdiesel_pagescroller_animation_hideshow_duration_hide', '500')),
      array('config.add', array('darkdiesel_pagescroller_animation_hideshow_visible_part', '20')),
      array('config.add', array('darkdiesel_pagescroller_animation_hideshow_distance_to_page', '0')),
      // Remove old ACP_PAGESCROLLER module if it exists
//      array('if', array(
//        array('module.exists', array('acp', false, 'ACP_PAGESCROLLER')),
//        array('module.remove', array('acp', false, 'ACP_PAGESCROLLER')),
//      )),
      // Add new ACP_PAGESCROLLER module
      array(
        'module.add',
        array(
          'acp',
          'ACP_CAT_DOT_MODS',
          'ACP_PAGESCROLLER'
        )
      ),
      array(
        'module.add',
        array(
          'acp',
          'ACP_PAGESCROLLER',
          array(
            'module_basename' => '\darkdiesel\pagescroller\acp\page_scroller_module',
            'modes'           => array('settings'),
          ),
        )
      ),
    );
  }
}
