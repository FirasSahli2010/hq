<?php

namespace SahelCore\Lib;

/**
 * interface PostTypeInterface
 * @package SahelCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}