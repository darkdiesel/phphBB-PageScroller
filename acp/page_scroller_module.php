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

class page_scroller_module {
  /** @var \phpbb\cache\driver\driver_interface */
  protected $cache;

  /** @var \phpbb\config\config */
  protected $config;

  /** @var \phpbb\config\db_text */
  protected $config_text;

  /** @var \phpbb\db\driver\driver_interface */
  protected $db;

  /** @var \phpbb\log\log */
  protected $log;

  /** @var \phpbb\request\request */
  protected $request;

  /** @var \phpbb\template\template */
  protected $template;

  /** @var \phpbb\user */
  protected $user;

  /** @var string */
  protected $phpbb_root_path;

  /** @var string */
  protected $php_ext;

  /** @var string */
  public $u_action;

  function main($id, $mode) {
    global $cache, $config, $db, $phpbb_log, $request, $template, $user, $phpbb_root_path, $phpEx, $phpbb_container;

    $this->cache = $cache;
    $this->config = $config;
    $this->config_text = $phpbb_container->get('config_text');
    $this->db = $db;
    $this->log = $phpbb_log;
    $this->request = $request;
    $this->template = $template;
    $this->user = $user;
    $this->phpbb_root_path = $phpbb_root_path;
    $this->php_ext = $phpEx;

    // Add the board rules ACP lang file
    $this->user->add_lang_ext('darkdiesel/pagescroller', 'pagescroller_acp');

    $this->tpl_name = 'pagescroller';
    $this->page_title = $user->lang('ACP_PAGESCROLLER_SETTINGS');

    add_form_key('darkdiesel/pagescroller');

    if ($this->request->is_set_post('submit'))
    {
      if (!check_form_key('darkdiesel/pagescroller'))
      {
        $this->user->add_lang('acp/common');
        trigger_error('FORM_INVALID');
      }

      $this->config->set('darkdiesel_pagescroller_horizontal_pos', $this->request->variable('darkdiesel_pagescroller_horizontal_pos', 'right'));
      $this->config->set('darkdiesel_pagescroller_vertical_pos', $this->request->variable('darkdiesel_pagescroller_vertical_pos', 'bottom'));

      $this->config->set('darkdiesel_pagescroller_style_type', $this->request->variable('darkdiesel_pagescroller_style_type', '1'));
      $this->config->set('darkdiesel_pagescroller_style_hide_btns', $this->request->variable('darkdiesel_pagescroller_style_hide_btns', 'false'));
      $this->config->set('darkdiesel_pagescroller_style_bgcolor', $this->request->variable('darkdiesel_pagescroller_style_bgcolor', '#0076b1'));
      $this->config->set('darkdiesel_pagescroller_style_chevroncolor', $this->request->variable('darkdiesel_pagescroller_style_chevroncolor', '#FFFFFF'));

      $this->config->set('darkdiesel_pagescroller_scroll_up_speed', $this->request->variable('darkdiesel_pagescroller_scroll_up_speed', '800'));
      $this->config->set('darkdiesel_pagescroller_scroll_down_speed', $this->request->variable('darkdiesel_pagescroller_scroll_down_speed', '800'));

      $this->config->set('darkdiesel_pagescroller_animation_hideshow_enable', $this->request->variable('darkdiesel_pagescroller_animation_hideshow_enable', 'false'));
      $this->config->set('darkdiesel_pagescroller_animation_hideshow_duration_show', $this->request->variable('darkdiesel_pagescroller_animation_hideshow_duration_show', '200'));
      $this->config->set('darkdiesel_pagescroller_animation_hideshow_duration_hide', $this->request->variable('darkdiesel_pagescroller_animation_hideshow_duration_hide', '500'));
      $this->config->set('darkdiesel_pagescroller_animation_hideshow_visible_part', $this->request->variable('darkdiesel_pagescroller_animation_hideshow_visible_part', '20'));
      $this->config->set('darkdiesel_pagescroller_animation_hideshow_distance_to_page', $this->request->variable('darkdiesel_pagescroller_animation_hideshow_distance_to_page', '0'));

      trigger_error($user->lang('ACP_PAGESCROLLER_SETTING_SAVED') . adm_back_link($this->u_action));
    }

    $this->template->assign_vars(array(
      'U_ACTION'				=> $this->u_action,
      'DARKDIESEL_PAGESCROLLER_HORIZONTAL_POS' => $this->config['darkdiesel_pagescroller_horizontal_pos'],
      'DARKDIESEL_PAGESCROLLER_VERTICAL_POS' => $this->config['darkdiesel_pagescroller_vertical_pos'],

      'DARKDIESEL_PAGESCROLLER_STYLE_TYPE' => $this->config['darkdiesel_pagescroller_style_type'],
      'DARKDIESEL_PAGESCROLLER_STYLE_HIDE_BTNS' => $this->config['darkdiesel_pagescroller_style_hide_btns'],
      'DARKDIESEL_PAGESCROLLER_STYLE_BGCOLOR' => $this->config['darkdiesel_pagescroller_style_bgcolor'],
      'DARKDIESEL_PAGESCROLLER_STYLE_CHEVRONCOLOR' => $this->config['darkdiesel_pagescroller_style_chevroncolor'],

      'DARKDIESEL_PAGESCROLLER_SCROLL_UP_SPEED' => $this->config['darkdiesel_pagescroller_scroll_up_speed'],
      'DARKDIESEL_PAGESCROLLER_SCROLL_DOWN_SPEED' => $this->config['darkdiesel_pagescroller_scroll_down_speed'],

      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_ENABLE' => $this->config['darkdiesel_pagescroller_animation_hideshow_enable'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_DURATION_SHOW' => $this->config['darkdiesel_pagescroller_animation_hideshow_duration_show'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_DURATION_HIDE' => $this->config['darkdiesel_pagescroller_animation_hideshow_duration_hide'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_VISIBLE_PART' => $this->config['darkdiesel_pagescroller_animation_hideshow_visible_part'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_DISTANCE_TO_PAGE' => $this->config['darkdiesel_pagescroller_animation_hideshow_distance_to_page'],

      'S_DARKDIESEL_PAGESCROLLER'	=> true,
    ));
  }
}
