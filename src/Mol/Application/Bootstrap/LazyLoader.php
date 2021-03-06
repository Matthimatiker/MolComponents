<?php

/**
 * Mol_Application_Bootstrap_LazyLoader
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */

/**
 * Class that uses a callback to lazy load resources.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */
class Mol_Application_Bootstrap_LazyLoader
{
    
    /**
     * The callback or null if it was already executed.
     *
     * @var mixed|null
     */
    protected $callback = null;
    
    /**
     * Holds the result of the callback after execution.
     *
     * @var mixed
     */
    protected $result = null;
    
    /**
     * Creates a lazy loader.
     *
     * @param mixed $callback A callback.
     * @throws InvalidArgumentException If the callback is not valid.
     */
    public function __construct($callback)
    {
        if (!is_callable($callback)) {
            $message = 'Valid callback expected.';
            throw new InvalidArgumentException($message);
        }
        $this->callback = $callback;
    }
    
    /**
     * Uses the callback to load the resource.
     *
     * @return mixed
     */
    public function load()
    {
        if ($this->callback !== null) {
            // Callback was not executed before.
            $this->result = call_user_func_array($this->callback, array());
            // Remove the callback to ensure that it is not executed again.
            $this->callback = null;
        }
        return $this->result;
    }
    
}
