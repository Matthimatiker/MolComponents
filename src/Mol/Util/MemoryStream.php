<?php

/**
 * Mol_Util_MemoryStream
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.07.2011
 */

/**
 * Stream helper class that allows writing into memory.
 *
 * May be used with functions that usually write to files only.
 *
 * Example:
 *
 *     $stream = new Mol_Util_MemoryStream();
 *     file_put_contents($stream, 'Hello World!');
 *
 * In contrast to the PHP memory stream wrapper this stream allows
 * reading from the stream later, even if it was closed after
 * previous write operations:
 *
 *     $stream = new Mol_Util_MemoryStream();
 *     $content = file_get_contents($stream);
 *
 * The stream handle is not required.
 *
 * The stream content may be pre-filled by passing the initial data to
 * the constructor:
 *
 *     $stream = new Mol_Util_MemoryStream('Hello World!');
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
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
    public function __construct($content = '')
    {
        if (!is_string($content)) {
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

