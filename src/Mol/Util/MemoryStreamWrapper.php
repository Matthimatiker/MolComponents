<?php

/**
 * Mol_Util_MemoryStreamWrapper
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
 * Low level class that allows to access MemoryStream objects via stream functions.
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.07.2011
 */
class Mol_Util_MemoryStreamWrapper
{
    /**
     * The scheme for streams that are handled by this wrapper.
     */
    const SCHEME = 'volatile';

    /**
     * Contains all registered buckets.
     *
     * The key is the bucket id, the value equals the bucket content.
     *
     * @var array(string=>string)
     */
    protected static $buckets = array();

    /**
     * The context.
     *
     * @var resource|null
     */
    public $context = null;

    /**
     * The id of the bucket that is handled by this object.
     *
     * @var string
     */
    protected $bucketId = null;

    /**
     * The current position in the bucket.
     *
     * @var integer
     */
    protected $position = 0;

    /**
     * Registers the stream wrapper.
     */
    public static function register()
    {
        if (in_array(self::SCHEME, stream_get_wrappers())) {
            // Wrapper is already registered.
            return;
        }
        stream_wrapper_register(self::SCHEME, __CLASS__);
    }

    /**
     * Registers a new stream bucket with the given id.
     *
     * The bucket will be initially filled with the provided content.
     *
     * @param string $id
     * @param string $initalContent
     */
    public static function registerBucket($id, $initalContent)
    {
        self::$buckets[$id] = $initalContent;
    }

    /**
     * Returns the whole content of the bucket with the given id.
     *
     * @param string $id
     * @return string
     */
    public static function readBucket($id)
    {
        return self::$buckets[$id];
    }

    /**
     * Removes the bucket with the given id.
     *
     * @param string $id
     */
    public static function unRegisterBucket($id)
    {
        unset(self::$buckets[$id]);
    }

    /**
     * Checks if the bucket with the provided id exists.
     *
     * @param string $id
     * @return boolean True if the bucket exists, false otherwise.
     */
    public static function hasBucket($id)
    {
        return isset(self::$buckets[$id]);
    }

    /**
     * Extracts the bucket id from the given url.
     *
     * Correct url for this wrapper look like this:
     * volatile://bucket_id
     *
     * @param string $url
     * @return string
     */
    protected static function extractBucketId($url)
    {
        return parse_url($url, PHP_URL_HOST);
    }

    /**
     * Returns the size of the bucket with the given id.
     *
     * The method returns 0 if the bucket does not exist.
     *
     * @param string $id
     * @return integer The size in bytes.
     */
    protected function getBucketSize($id)
    {
        if (!self::hasBucket($id)) {
            return 0;
        }
        return strlen(self::$buckets[$id]);
    }

    /**
     * Returns the current bucket size in bytes.
     *
     * @return integer
     */
    protected function getSize()
    {
        return self::getBucketSize($this->bucketId);
    }

    // @codingStandardsIgnoreStart Unused parameters exist for interface compability.
    /**
     * Opens a stream.
     *
     * The provided url is used to identify the bucket
     * whose content is modified.
     *
     * @param string $path
     * @param string $mode
     * @param integer $options
     * @param string $openedPath
     * @return boolean
     * @throws RuntimeException If the requested bucket does not exist.
     */
    public function stream_open($path, $mode, $options, $openedPath)
    {
        $this->bucketId = parse_url($path, PHP_URL_HOST);
        if(!self::hasBucket($this->bucketId) ) {
            throw new RuntimeException('Bucket "' . $this->bucketId . '" does not exist.');
        }

        $mode = str_replace('b', '', strtolower($mode));
        switch($mode ) {
            case 'r':
            case 'r+':
                $this->position = 0;
                break;
            case 'w':
            case 'w+':
                self::$buckets[$this->bucketId] = '';
                $this->position = 0;
                break;
            case 'a':
            case 'a+':
                $this->position = $this->getSize();
                break;
        }

        return true;
    }

    /**
     * Returns information about a stream.
     *
     * Returns false if no information is available.
     *
     * @param string $path
     * @param integer $flags
     * @return array(mixed=>mixed)|boolean
     */
    public function url_stat($path, $flags)
    {
        $id = self::extractBucketId($path);
        if(!self::hasBucket($id) ) {
            return false;
        }
        $info = array(
            'mode' => 0100666,
            'size' => self::getBucketSize($id)
        );
        return $info;
    }
    // @codingStandardsIgnoreEnd

    /**
     * Returns information about the stream.
     *
     * @return array(mixed=>mixed)
     */
    public function stream_stat()
    {
        $info = array(
            'size' => $this->getSize()
        );
        return $info;
    }

    /**
     * Returns $count bytes from the bucket.
     *
     * @param integer $count
     * @return string
     */
    public function stream_read($count)
    {
        $result          = substr(self::$buckets[$this->bucketId], $this->position, $count);
        $this->position += strlen($result);
        return $result;
    }

    /**
     * Writes $data to the bucket.
     *
     * @param string $data
     * @return integer The number of written bytes.
     */
    public function stream_write($data)
    {
        $this->insert($data, $this->position);
        $this->position += strlen($data);
        return strlen($data);
    }

    /**
     * Inserts the given data block at the provided position.
     *
     * The content from $position to $position + strlen($data)
     * will be overwritten.
     *
     * @param string $data
     * @param integer $position
     */
    protected function insert($data, $position)
    {
        if ($position === 0) {
            $start = '';
        } else {
            $start = substr(self::$buckets[$this->bucketId], 0, $position);
        }
        if ($position + strlen($data) >= $this->getSize()) {
            $end = '';
        } else {
            $end = substr(self::$buckets[$this->bucketId], $position + strlen($data));
        }
        self::$buckets[$this->bucketId] = $start . $data . $end;
    }

    /**
     * Writes cached data.
     *
     * @return boolean
     */
    public function stream_flush()
    {
        return true;
    }

    /**
     * Returns the current position in the bucket.
     *
     * @return integer
     */
    public function stream_tell()
    {
        return $this->position;
    }

    /**
     * Checks if the current position is at the end of the stream.
     *
     * @return boolean
     */
    public function stream_eof()
    {
        return $this->position >= $this->getSize();
    }

    /**
     * Sets the position in the stream.
     *
     * @param integer $offset
     * @param integer $whence
     * @return boolean
     */
    public function stream_seek($offset, $whence = SEEK_SET)
    {
        switch($whence ) {
            case SEEK_CUR:
                $newPosition = $this->position + $offset;
                break;
            case SEEK_END:
                $newPosition = $this->getSize() + $offset;
                break;
            case SEEK_SET:
            default:
                $newPosition = $offset;
        }
        if ($newPosition < 0) {
            return false;
        }
        $this->position = min($newPosition, $this->getSize());
        return true;
    }

    /**
     * Closes the stream.
     */
    public function stream_close()
    {
    }

}

