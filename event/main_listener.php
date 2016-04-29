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

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface {
  /** @var \phpbb\config\config */
  protected $config;

  /** @var \phpbb\controller\helper */
  protected $controller_helper;

  /** @var \phpbb\template\template */
  protected $template;

  /** @var \phpbb\user */
  protected $user;

  /** @var string phpEx */
  protected $php_ext;

  /**
   * Constructor
   *
   * @param \phpbb\config\config $config Config object
   * @param \phpbb\controller\helper $controller_helper Controller helper object
   * @param \phpbb\template\template $template Template object
   * @param \phpbb\user $user User object
   * @param string $php_ext phpEx
   *
   * @access public
   */
  public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $controller_helper, \phpbb\template\template $template, \phpbb\user $user, $php_ext) {
    $this->config            = $config;
    $this->controller_helper = $controller_helper;
    $this->template          = $template;
    $this->user              = $user;
    $this->php_ext           = $php_ext;
  }

  static public function getSubscribedEvents() {
    return array(
      'core.user_setup'  => 'load_language_on_setup',
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
  
  public function setup_page_scroller(){
    $this->template->assign_vars(array(
      'DARKDIESEL_PAGESCROLLER_HORIZONTAL_POS' => $this->config['darkdiesel_pagescroller_horizontal_pos'],
      'DARKDIESEL_PAGESCROLLER_VERTICAL_POS'   => $this->config['darkdiesel_pagescroller_vertical_pos']
    ));
  }
}
