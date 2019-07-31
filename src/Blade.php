<?php

namespace FloatingPoint\Wp\Blade;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerInterface;
use Illuminate\Contracts\View\Factory as FactoryContract;
use Illuminate\Contracts\View\View;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory;
use Illuminate\View\ViewServiceProvider;

/**
 * Class that adds support for Laravel Blade
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class Blade implements FactoryContract
{

    /**
     *
     * The instace of the classs
     *
     * @since	1.0.0
     * @access	private
     * @var		self		$instance
     */
    private static $instance = null;

    /**
     * Container interface
     *
     * @since    1.0.0
     * @access   protected
     * @var      Container    $container
     */
    protected $container;

    /**
     * Factory contract
     *
     * @since    1.0.0
     * @access   private
     * @var      Factory    $factory
     */
    private $factory;

    /**
     * The blade compiler
     *
     * @since    1.0.0
     * @access   private
     * @var      BladeCompiler    $compiler
     */
    private $compiler;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param    array<mixed>    $viewPaths       Paths where views are stored
     * @param	string			$cachePath		Path where to cache views
     * @param	Container		$container		The container interface
     * @return	void
     */
    public function __construct($viewPaths, $cachePath, $container = null)
    {
        $this->container = $container ? $container : new Container;

        $this->setupContainer((array) $viewPaths, $cachePath);
        (new ViewServiceProvider($this->container))->register();

        $this->factory = $this->container->get('view');
        $this->compiler = $this->container->get('blade.compiler');
    }

    /**
     * Render a view
     *
     * @since	1.0.0
     * @param	string	$view	Name of the view to render
     * @param	array<mixed>	$data		Data to pass to the view
     * @param	array<mixed>	$mergeData		Data merged with the view
     * @return	string			HTML for the compiled view
     */
    public function render($view, $data = [], $mergeData = [])
    {
        return $this->make($view, $data, $mergeData)->render();
    }

    /**
     * Make a view
     *
     * @since	1.0.0
     * @param	string	$view	Name of the view to render
     * @param	array<mixed>	$data		Data to pass to the view
     * @param	array<mixed>	$mergeData		Data merged with the view
     * @return	View
     */
    public function make($view, $data = [], $mergeData = [])
    {
        return $this->factory->make($view, $data, $mergeData);
    }

    /**
     * Get the blade compiler
     *
     * @since	1.0.0
     * @return	BladeCompiler
     */
    public function compiler()
    {
        return $this->compiler;
    }

    /**
     * Setup a directive
     *
     * @since	1.0.0
     * @param	string	$name	Name of the directive
     * @param	callable	$handler	Directive function
     * @return	void
     */
    public function directive($name, $handler)
    {
        $this->compiler->directive($name, $handler);
    }

    /**
     * Determine if view exists
     *
     * @since	1.0.0
     * @param	View	$view
     * @return	boolean
     */
    public function exists($view)
    {
        return $this->factory->exists($view);
    }

    /**
     * Create a view file
     *
     * @since	1.0.0
     * @param	string			$path		Path to the view
     * @param	array<mixed>	$data
     * @param	array<mixed>	$mergeData
     * @return	View
     */
    public function file($view, $data = [], $mergeData = [])
    {
        return $this->factory->file($view, $data, $mergeData);
    }

    /**
     * Get a shared value
     *
     * @since	1.0.0
     * @param	string		$key		Value key
     * @param	mixed		$value
     * @return	mixed
     */
    public function share($key, $value = null)
    {
        return $this->factory->shared($key, $value);
    }

    /**
     * Compose views
     *
     * @since	1.0.0
     * @param	array<mixed>	$views
     * @param	callable		$callback
     * @return	array
     */
    public function composer($views, $callback)
    {
        return $this->factory->composer($views, $callback);
    }

    /**
     * Create views
     *
     * @since	1.0.0
     * @param	array<mixed>	$views
     * @param	callable		$callback
     * @return	array
     */
    public function creator($views, $callback)
    {
        return $this->factory->creator($views, $callback);
    }

    /**
     * Add a namespace to self
     *
     * @since	1.0.0
     * @param	string	$namespace
     * @param	string	$hints
     * @return	self
     */
    public function addNamespace($namespace, $hints)
    {
        $this->factory->addNamespace($namespace, $hints);
        return $this;
    }

    /**
     * Replace an exising namespace
     *
     * @since	1.0.0
     * @param	string	$namespace
     * @param	string	$hints
     * @return	self
     */
    public function replaceNamespace($namespace, $hints): self
    {
        $this->factory->replaceNamespace($namespace, $hints);
        return $this;
    }

    /**
     * Magic call
     *
     * @since	1.0.0
     * @param	string			$method
     * @param 	array<mixed>	$params
     * @return callable
     */
    public function __call($method, array $params)
    {
        return call_user_func_array([$this->factory, $method], $params);
    }

    /**
     * Setup the container
     *
     * @since	1.0.0
     * @param	array<string>		$viewPaths
     * @param	string				$cachePath
     */
    protected function setupContainer($viewPaths, $cachePath)
    {
        $this->container->bindIf('files', function () {
            return new Filesystem;
        }, true);
        $this->container->bindIf('events', function () {
            return new Dispatcher;
        }, true);
        $this->container->bindIf('config', function () use ($viewPaths, $cachePath) {
            return [
                'view.paths' => $viewPaths,
                'view.compiled' => $cachePath,
            ];
        }, true);
    }

    /**
     * Get the singleton
     *
     * @since	1.0.0
     * @return self
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $uploadDir = wp_upload_dir();
            self::$instance = new Blade(Config::getValue('view_path'), $uploadDir['basedir'] . '/cache');
        }

        return self::$instance;
    }
}
