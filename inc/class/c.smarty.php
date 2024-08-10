<?php
/********************************************************************************
* smarty.php 	                                                                *
*********************************************************************************
* Mscript: Desarrollado por marcofbb											*
* ==============================================================================*
* Software Version:           MOVIE SCRIPT BETA   								*
*********************************************************************************/

/*
	SUBCLASE DE LA CLASE SMARTY
	
	METODOS EN ESTA CLASE:
	
	ofSmarty()
	getInstance()
	assign_hooks()
*/

require(MS_ROOT.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'smarty'.DIRECTORY_SEPARATOR.'Smarty.class.php');


class msSmarty extends Smarty
{  
  
  
  function msSmarty()
  {
    global $msCore;
    //
    $this->template_dir = MS_ROOT.DIRECTORY_SEPARATOR.'Temas'.DIRECTORY_SEPARATOR.MS_TEMA.DIRECTORY_SEPARATOR.'templates';
    $this->compile_dir = MS_ROOT.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'smarty'.DIRECTORY_SEPARATOR.'templates_c';
    $this->cache_dir = MS_ROOT.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'smarty'.DIRECTORY_SEPARATOR.'cache';
    $this->config_dir = MS_ROOT.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'smarty'.DIRECTORY_SEPARATOR.'configs'; 
    $this->template_cb = array('url' => $msCore->settings['datos']['w_url'], 'title' => $msCore->settings['datos']['w_titulo']);
    //
    $this->_tpl_hooks = array();
  }
  
  
  
  function &getInstance()
  {
    static $instance;
    
    if( is_null($instance) )
    {
      $instance = new msSmarty();
    }
    
    return $instance;
  }  
  
  function assign_hook($hook, $include)
  {
    if( !isset($this->_tpl_hooks[$hook]) )
      $this->_tpl_hooks[$hook] = array();
    
    if( $this->_tpl_hooks_no_multi && in_array($include, $this->_tpl_hooks[$hook]) )
      return;
    
    $this->_tpl_hooks[$hook][] = $include;
  }
}

?>