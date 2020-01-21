<?php

namespace FloatingPoint\Wp;

/**
 * Main Functions Class
 *
 * @package FpPrograms
 */
class Functions
{
    /**
     * Functions
     *
     * @access protected
     * @var array
     */
    protected $functions;

    /**
     * Initialize Class and Template Tags
     */
    public function __construct(array $components = [])
    {
        foreach ($components as $component) {
            if ($component instanceof Interfaces\ComponentInterface) {
                $this->setFunction($component);
            }
        }
    }

    /**
     * Set the functions
     *
     * @param	FunctionInterface	$component		The template component
     * @return	void
     */
    protected function setFunction(Interfaces\FunctionInterface $component)
    {
        $tags = $component->functions();

        foreach ($tags as $method => $callback) {
            if (\is_callable($callback)) {
                if (isset($this->functions[$method])) {
                    throw new RuntimeException(
                        sprintf(
                            __('The template tag method %1$s registered by theme component %2$s conflicts with an already registered template tag of the same name.', 'fp-fabric'),
                            $method_name,
                            get_class($component)
                        )
                    );
                }

                $this->functions[$method] = [ 'callback' => $callback ];
            }
        }
    }

    /**
     * Call method for tags
     *
     * @param	string		$method		Name of the method
     * @param	array		$args		Method Arguments
     * @return	mixed
     */
    public function __call(string $method, array $args)
    {
        if (isset($this->functions[$method])) {
            return call_user_func_array($this->functions[$method]['callback'], $args);
        }
    }
}
