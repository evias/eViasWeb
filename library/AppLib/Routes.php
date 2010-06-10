<?php

class AppLib_Routes
	extends eVias_Routes
{
	/**
	 * Fetch all application's routes
	 *
	 * @todo : read config file to fetch routes
	 *
	 */
	public static function fetch() {
		static $routes;

		if (! isset($routes)) {
			$routes = array(
				'default'			=> new Zend_Controller_Router_Route_Static(
					'/',
					array(
						'module'	=> 'default',
						'controller'=> 'index',
						'action'	=> 'index')),
// ------------- BLOG ROUTES
				'blog'				=> new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Module de Blog'),
					array(
						'module'	=> 'blog',
						'controller'=> 'index',
						'action'	=> 'index')),
				'blog/write'       => new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Ecrire un billet'),
					array(
  						'module'	=> 'blog',
						'controller'=> 'index',
						'action'	=> 'write')),
				'blog/admin'       => new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Gestion du blog'),
					array(
  						'module'	=> 'blog',
						'controller'=> 'index',
						'action'	=> 'admin')),
				'blog/comment/add'       => new Zend_Controller_Router_Route_Static(
					'blog/comment/add/:id',
					array(
  						'module'	=> 'blog',
						'controller'=> 'index',
						'action'	=> 'save-comment')),
// ------------- CATALOGUE ROUTES
				'catalogue'			=> new Zend_Controller_Router_Route_Static(
					'catalogue',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'index',
						'action'	=> 'index')),
    			'catalogue/articles/list' => new Zend_Controller_Router_Route_Static(
					'catalogue/articles',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'index',
						'action'	=> 'article-list')),
    			'catalogue/categories/list' => new Zend_Controller_Router_Route_Static(
					'catalogue/categories',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'index',
						'action'	=> 'category-list')),
				'catalogue/stats'	=> new Zend_Controller_Router_Route_Static(
					'catalogue/stats',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'stats',
						'action'	=> 'index')),
// ------------- MEMBER ROUTES
				'member'			=> new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Panel membre'),
					array(
						'module'	=> 'member',
						'controller'=> 'index',
						'action'	=> 'index')),
				'member/login'		=> new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Panel membre Identification'),
					array(
  						'module'	=> 'member',
						'controller'=> 'index',
						'action'	=> 'login')),
				'member/logout'		=> new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Panel membre Déconnexion'),
					array(
  						'module'	=> 'member',
						'controller'=> 'index',
						'action'	=> 'logout')),
				'member/profile'    => new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Profil membre'),
					array(
  						'module'	=> 'member',
						'controller'=> 'index',
						'action'	=> 'profile')),

			);
		}

		return $routes;
	}
}
