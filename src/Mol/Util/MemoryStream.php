<?php

/**
 * Mol_Util_MemoryStream
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Util
 * @copyright  2011-2012 Matthias Molitor
 * @version $Rev: 497 $
 * @since 05.07.2011
 */

/**
 * Stream helper class that allows writing into memory.
 *
 * May be used with function that usually write to files only.
 *
 * Example:
 * <code>
 * $stream = new Mol_Util_MemoryStream();
 * file_put_contents($stream, 'Hello World!');
 * </code>
 *
 * In contrast to the PHP memory stream wrapper this stream allows
 * reading from the stream later, even if it was closed after
 * previous write operations:
 * <code>
 * $stream = new Mol_Util_MemoryStream();
 * $content = file_get_contents($stream);
 * </code>
 * The stream handle is not required.
 *
 * The stream content may be pre-filled by passing the initial data to
 * the constructor:
 * <code>
 * $stream = new Mol_Util_MemoryStream('Hello World!');
 * </code>
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Util
 * @copyright  2011-2012 Matthias Molitor
 * @version $Rev: 497 $
 * @since 05.07.2011
 */
class Mol_Util_MemoryStream
{
    /**
     * The identifier for this stream object.
     *
     * @var string
     */
    protected $id = null;

    /**
     * Creates a new stream.
     *
     * @param string $content The initial stream content.
     * @throws RuntimeException If an invalid argument is passed.
     */
    public function __construct( $content = '' )
    {
        if( !is_string($content) ) {
            $message = 'String expected, but' . gettype($content) . ' received.';
            throw new RuntimeException($message);
        }
        $this->id = uniqid();
        Mol_Util_MemoryStreamWrapper::register();
        Mol_Util_MemoryStreamWrapper::registerBucket($this->id, $content);
    }

    /**
     * Returns the current content of the stream.
     *
     * @return string
     */
    public function getContent()
    {
        return Mol_Util_MemoryStreamWrapper::readBucket($this->id);
    }

    /**
     * Returns the identifier for this stream.
     *
     * The stream identifier is passed to functions that read
     * or write to this stream.
     *
     * @return string
     */
    public function __toString()
    {
        return Mol_Util_MemoryStreamWrapper::SCHEME . '://' . $this->id;
    }

    /**
     * Cleans up the environment.
     */
    public function __destruct()
    {
        Mol_Util_MemoryStreamWrapper::unRegisterBucket($this->id);
    }

}

