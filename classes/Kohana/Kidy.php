<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Kidy
{	
	public static function repair_string($html)
	{
		if (class_exists('tidy')) 
		{
			//$config = Kohana_config::instance();
			
			$reader = Kohana::$config->load('kidy');
			
			$tidy = new tidy();
			
			$clean = $tidy->repairString($html, $reader->as_array(), $reader->get('char-encoding'));
			
			return $clean;
			
		} else {
		
			Kohana::$log->add(Log::INFO, 'Tidy is not enabled');
					 
			return $html;
		}
	}
	
	public static function clean_repair($html)
	{
		if (class_exists('tidy')) 
		{
			//$config = Kohana_config::instance();
			
			$reader = Kohana::$config->load('kidy');
			
			$tidy = tidy_parse_string($html, $reader->as_array(), $reader->get('char-encoding'));
			
			$tidy->cleanRepair();
			
			return $tidy->value;
			
		} else {
			
			Kohana::$log->add(Log::INFO, 'Tidy is not enabled');
			
			return $html;
		}
	}
}