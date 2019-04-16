<?php

/** 
* @package WordPress-Plugin
*/

/* 
Plugin Name:MyFirstPlugin
version:1.0.0
 */
 
 if(! defined('ABSPATH'))
 {
	 die ;
 }

 class MyFirstPlugin
	{
		function __construct()
		{
			add_action('init',array($this,'custom_post_type'));
		}
		function register()
		{
			add_action('admin_enqueue_scripts',array($this,'enqueue'));
		}
		function activate()
		{
			$this->custom_post_type();
			flush_rewrite_rules();
		}
		function deactivate()
		{
	  
		}
		function uninstall()
		{
		  
		}
	  
		function custom_post_type()
		{
			register_post_type('book', ['public' => true,'label' => 'Books']);
		}
	  
		function enqueue()
		{
			wp_enqueue_style('mystyle',plugins_url('/assets/mystyle.css',__FILE__));
			wp_enqueue_script('myscript',plugins_url('/assets/myscript.js',__FILE__));
		}
	  
	}
 if(class_exists('MyFirstPlugin'))
	{
		$MyFirstPlugin = new MyFirstPlugin("new parameter");
		$MyFirstPlugin-> register();
	}
	//activation
	register_activation_hook(__FILE__,array($MyFirstPlugin,'activate'));
	
	//deactivation
	register_deactivation_hook(__FILE__,array($MyFirstPlugin,'deactivate'));