<?php

class AppLib_Routes
	extends eVias_Routes
{
	/**
	 * Fetch all application's routes
	 *
     * @todo : split routes into modules init !
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
                'informations'      => new Zend_Controller_Router_Route_Static(
                    self::cleanUrl(__('__URL_REWRITE_PERSONAL_INFO__')),
                    array (
                        'module'    => 'default',
                        'controller'=> 'index',
                        'action'    => 'informations')),
                'presentation'      => new Zend_Controller_Router_Route_Static(
                    self::cleanUrl('noname'),
                    array (
                        'module'    => 'default',
                        'controller'=> 'index',
                        'action'    => 'presentation')),
                'language'      => new Zend_Controller_Router_Route(
                    'langue',
                    array (
                        'module'    => 'default',
                        'controller'=> 'index',
                        'action'    => 'language')),
// ------------- TOOLBAR ROUTES
				'toolbar/my/access'	=> new Zend_Controller_Router_Route_Static(
                    'toolbar/my/access',
					self::cleanUrl('Mes AccÃ¨s'),
					array(
						'module'	=> 'default', // @FIXME
						'controller'=> 'index',
						'action'	=> 'index')),
				'toolbar/my/page'	=> new Zend_Controller_Router_Route_Static(
                    'toolbar/my/page',
					self::cleanUrl('Ma page'),
					array(
						'module'	=> 'default', // @FIXME
						'controller'=> 'index',
						'action'	=> 'index')),
// ------------- BLOG ROUTES
				'blog'				=> new Zend_Controller_Router_Route_Static(
					self::cleanUrl(__('__URL_REWRITE_BLOG_HOME__')),
					array(
						'module'	=> 'blog',
						'controller'=> 'index',
						'action'	=> 'index')),
				'blog/members'		=> new Zend_Controller_Router_Route_Static(
					self::cleanUrl(__('__URL_REWRITE_BLOG_MEMBERS__')),
					array(
						'module'	=> 'blog',
						'controller'=> 'members',
						'action'	=> 'index')),
				'blog/write'       => new Zend_Controller_Router_Route_Static(
					self::cleanUrl(__('__URL_REWRITE_BLOG_WRITE__')),
					array(
  						'module'	=> 'blog',
						'controller'=> 'index',
						'action'	=> 'write')),
				'blog/admin'       => new Zend_Controller_Router_Route_Static(
					self::cleanUrl(__('__URL_REWRITE_BLOG_ADMIN__')),
					array(
  						'module'	=> 'blog',
						'controller'=> 'index',
						'action'	=> 'admin')),
                'blog/article/like' => new Zend_Controller_Router_Route (
                    'blog/article/like/:id',
                    array (
                        'module' => 'blog',
                        'controller'=> 'index',
                        'action' => 'like-article')),
				'blog/comment/add'       => new Zend_Controller_Router_Route (
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
    			'catalogue/categories/manage' => new Zend_Controller_Router_Route_Static(
					'catalogue/categories/gestion',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'categories',
						'action'	=> 'index')),
    			'catalogue/categories/form/add' => new Zend_Controller_Router_Route_Static(
					'catalogue/categories/ajouter',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'categories',
						'action'	=> 'add')),
    			'catalogue/categories/sort' => new Zend_Controller_Router_Route(
					'catalogue/categories/ordonner/:order',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'categories',
						'action'	=> 'sort')),
    			'catalogue/categories/form/edit' => new Zend_Controller_Router_Route(
					'catalogue/categories/modifier/:id',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'categories',
						'action'	=> 'edit'),
                    array('id' => '\d+')),
    			'catalogue/categories/form/process' => new Zend_Controller_Router_Route_Static(
					'catalogue/categories/sauvegarde',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'categories',
						'action'	=> 'process')),
    			'catalogue/articles/manage' => new Zend_Controller_Router_Route_Static(
					'catalogue/articles/gestion',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'articles',
						'action'	=> 'index')),
    			'catalogue/articles/form/add' => new Zend_Controller_Router_Route_Static(
					'catalogue/articles/ajouter',
					array(
						'module'	=> 'catalogue',
						'controller'=> 'articles',
						'action'	=> 'add')),
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
				'member/stats'    => new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Profil membre'),
					array(
  						'module'	=> 'member',
						'controller'=> 'stats',
						'action'	=> 'index')),

				'member/profile'    => new Zend_Controller_Router_Route_Static(
					self::cleanUrl('Profil membre'),
					array(
  						'module'	=> 'member',
						'controller'=> 'profile',
						'action'	=> 'index')),

			);
		}

		return $routes;
	}
}
