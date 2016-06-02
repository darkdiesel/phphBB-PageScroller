<?php
/**
 *
 * @package phpBB Extension - Page Scroller
 * @copyright (c) Igor Peshkov (dark_diesel) <https://plus.google.com/+IgorPeshkov>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 * For full copyright and license information, contact with developer
 */

namespace darkdiesel\pagescroller\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\extension\manager;
use darkdiesel\pagescroller\ext;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface {
  /** @var \phpbb\config\config */
  protected $config;

  /** @var \phpbb\controller\helper */
  protected $extension_manager;

  /** @var \phpbb\template\template */
  protected $template;

  /** @var string */
  protected $root_path;

  /**
   * Constructor
   *
   * @param \phpbb\config\config $config Config object
   * @param manager $extension_manager Extension manager object
   * @param \phpbb\template\template $template Template object
   * @param string $root_path phpBB root path
   *
   * @access public
   */
  public function __construct(\phpbb\config\config $config, manager $extension_manager, \phpbb\template\template $template, $root_path) {
    $this->config            = $config;
    $this->extension_manager = $extension_manager;
    $this->template          = $template;
    $this->root_path         = $root_path;
  }

  static public function getSubscribedEvents() {
    return array(
      'core.user_setup'        => 'load_language_on_setup',
      'core.page_header_after' => 'setup_page_scroller'
    );
  }

  public function load_language_on_setup($event) {
    $lang_set_ext          = $event['lang_set_ext'];
    $lang_set_ext[]        = array(
      'ext_name' => 'darkdiesel/pagescroller',
      'lang_set' => 'pagescroller_common',
    );
    $event['lang_set_ext'] = $lang_set_ext;
  }

  public function setup_page_scroller() {
    $img_style = $this->config['darkdiesel_pagescroller_style_type'];


    static $images = array();

    if (empty($images)) {
      $images = $this->get_images($img_style . '.svg');
    }

    $chevron_up_img = 'pagescroller/styles/all/theme/assets/images/' . 'chevron-up-style' . $img_style . '.svg';
    $chevron_up_img = (isset($images['ext/' . $chevron_up_img])) ? 'ext/darkdiesel/' . $chevron_up_img : '';

    if ($chevron_up_img) {
      $chevron_up_img = file_get_contents($this->root_path . $chevron_up_img);
    }

    $chevron_down_img = 'pagescroller/styles/all/theme/assets/images/' . 'chevron-down-style' . $img_style . '.svg';
    $chevron_down_img = (isset($images['ext/' . $chevron_down_img])) ? 'ext/darkdiesel/' . $chevron_down_img : '';

    if ($chevron_down_img) {
      $chevron_down_img = file_get_contents($this->root_path . $chevron_down_img);
    }

    // get only svg tag from file
    $find_string = '<svg';

    if ($chevron_up_img) {
      $position       = strpos($chevron_up_img, $find_string);
      $chevron_up_img = substr($chevron_up_img, $position);
    }

    if ($chevron_down_img) {
      $position         = strpos($chevron_down_img, $find_string);
      $chevron_down_img = substr($chevron_down_img, $position);
    }

    $this->template->assign_vars(array(
      'DARKDIESEL_PAGESCROLLER_HORIZONTAL_POS' => $this->config['darkdiesel_pagescroller_horizontal_pos'],
      'DARKDIESEL_PAGESCROLLER_VERTICAL_POS'   => $this->config['darkdiesel_pagescroller_vertical_pos'],

      'DARKDIESEL_PAGESCROLLER_IMAGE_CHEVRON_UP'   => $chevron_up_img,
      'DARKDIESEL_PAGESCROLLER_IMAGE_CHEVRON_DOWN' => $chevron_down_img,

      'DARKDIESEL_PAGESCROLLER_STYLE_HIDE_BTNS' => $this->config['darkdiesel_pagescroller_style_hide_btns'],
      'DARKDIESEL_PAGESCROLLER_STYLE_BGCOLOR'      => $this->config['darkdiesel_pagescroller_style_bgcolor'],
      'DARKDIESEL_PAGESCROLLER_STYLE_CHEVRONCOLOR' => $this->config['darkdiesel_pagescroller_style_chevroncolor'],

      'DARKDIESEL_PAGESCROLLER_SCROLL_UP_SPEED'   => $this->config['darkdiesel_pagescroller_scroll_up_speed'],
      'DARKDIESEL_PAGESCROLLER_SCROLL_DOWN_SPEED' => $this->config['darkdiesel_pagescroller_scroll_down_speed'],

      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_ENABLE'           => $this->config['darkdiesel_pagescroller_animation_hideshow_enable'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_DURATION_SHOW'    => $this->config['darkdiesel_pagescroller_animation_hideshow_duration_show'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_DURATION_HIDE'    => $this->config['darkdiesel_pagescroller_animation_hideshow_duration_hide'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_VISIBLE_PART'     => $this->config['darkdiesel_pagescroller_animation_hideshow_visible_part'],
      'DARKDIESEL_PAGESCROLLER_ANIMATION_HIDESHOW_DISTANCE_TO_PAGE' => $this->config['darkdiesel_pagescroller_animation_hideshow_distance_to_page'],
    ));
  }

  /**
   * Get image paths/names from ABBC3's icons folder
   *
   * @return array File data from ./ext/vse/abbc3/images/icons
   * @access protected
   */
  protected function get_images($suffix) {
    $finder = $this->extension_manager->get_finder();

    return $finder
      ->extension_suffix($suffix)
      ->extension_directory('/styles/all/theme/assets/images/')
      ->find_from_extension('pagescroller', $this->root_path . ext::DARKDIESEL_PAGESCROLLER_ROOT_PATH);
  }
}
