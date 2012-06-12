<?php

/**
 * Mol_Util_StringStream
 *
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright  2011-2012 Matthias Molitor
 * @version $Rev: 485 $
 * @since 02.07.2011
 */

/**
 * Helper class that simplifies reading from strings via stream functions.
 *
 * The helper may be used to pass string to function that usually support
 * files only.
 *
 * Example:
 * <code>
 * $data = 'Hello World!';
 * // $content contains "Hello World!"
 * $content = file_get_contents(new Mol_Util_StringStream($data));
 * </code>
 *
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright  2011-2012 Matthias Molitor
 * @version $Rev: 485 $
 * @since 02.07.2011
 */
class Mol_Util_StringStream
{
    /**
     * The string that will be accessible via stream.
     *
     * @var string
     */
    protected $string = null;

    /**
     * Creates a object that is able to create the stream
     * identifier for the given string.
     *
     * @param string $string
     * @throws RuntimeException If no string was provided.
     */
    public function __construct( $string )
    {
        if( !is_string($string) ) {
            $message = 'String expected, but ' . gettype($string) . ' passed.';
            throw new RuntimeException($message);
        }
        $this->string = $string;
    }

    /**
     * Returns the stream identifier.
     *
     * @return string
     */
    public function __toString()
    {
        return 'data://text/plain,' . urlencode($this->string);
    }

}

