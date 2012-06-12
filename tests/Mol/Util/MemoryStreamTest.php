<?php

/**
 * Mol_Util_MemoryStreamTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Util
 * @subpackage Tests
 * @copyright  2011-2012 Matthias Molitor
 * @version $Rev: 504 $
 * @since 05.07.2011
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the memory stream.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Util
 * @subpackage Tests
 * @copyright  2011-2012 Matthias Molitor
 * @version $Rev: 504 $
 * @since 05.07.2011
 */
class Mol_Util_MemoryStreamTest extends PHPUnit_Framework_TestCase
{
    /**
     * The initial stream content.
     */
    const INITIAL_CONTENT = 'Hello World';

    /**
     * System under test.
     *
     * @var Mol_Util_MemoryStream
     */
    protected $stream = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->stream = new Mol_Util_MemoryStream(self::INITIAL_CONTENT);
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->stream = null;
        parent::tearDown();
    }

    /**
     * Ensures that the constructor throws an exception if an invalid
     * argument is passed.
     */
    public function testConstructorThrowsExceptionIfNoStringIsProvided()
    {
        $this->setExpectedException('RuntimeException');
        new Mol_Util_MemoryStream(new stdClass());
    }

    /**
     * Checks if the stream contains the initial content.
     */
    public function testStreamContainsInitialContent()
    {
        $this->assertEquals(self::INITIAL_CONTENT, $this->stream->getContent());
    }

    /**
     * Tests if the magic __toString() method returns a stream identifier.
     */
    public function testToStringReturnsStreamIdentifier()
    {
        $identifier = (string)$this->stream;
        $this->assertFalse(empty($identifier), 'Stream identifier is empty.');
    }

    /**
     * Ensures that each stream has its own identifier.
     */
    public function testEachStreamHasItsOwnIdentifier()
    {
        $anotherStream = new Mol_Util_MemoryStream();
        $this->assertNotEquals((string)$this->stream, (string)$anotherStream);
    }

    /**
     * Checks if the stream is readable by stream functions.
     */
    public function testStreamIsReadableViaStreamFunctions()
    {
        $content = file_get_contents($this->stream);
        $this->assertEquals(self::INITIAL_CONTENT, $content);
    }

    /**
     * Checks if the stream is writable by stream functions.
     */
    public function testStreamIsWritableViaStreamFunctions()
    {
        $newContent = 'Write me. Now!';
        file_put_contents($this->stream, $newContent);
        $this->assertEquals($newContent, $this->stream->getContent());
    }

    /**
     * Ensures that previously written content is readable via stream
     * functions afterwards.
     */
    public function testReadOperationReturnsPreviouslyWrittenContent()
    {
        $newContent = 'Write me. Now!';
        file_put_contents($this->stream, $newContent);
        $received = file_get_contents($this->stream);
        $this->assertEquals($newContent, $received);
    }

    /**
     * Ensures that the contents of multiple stream instances that are
     * written "parallel" do not interfere.
     */
    public function testMultipleStreamsDoNotInterfere()
    {
        $anotherStream = new Mol_Util_MemoryStream();
        $handle        = fopen($this->stream, 'wb');
        $anotherHandle = fopen($anotherStream, 'wb');
        fwrite($handle, 'First');
        fwrite($anotherHandle, 'content of');
        fwrite($handle, ' stream');
        fwrite($anotherHandle, ' second stream');
        fclose($handle);
        fclose($anotherHandle);
        $message = 'Invalid content in first stream.';
        $this->assertEquals('First stream', $this->stream->getContent(), $message);
        $message = 'Invalid content in second stream.';
        $this->assertEquals('content of second stream', $anotherStream->getContent(), $message);
    }

    /**
     * Checks if ftell() returns the correct pointer position.
     */
    public function testFtellReturnsCorrectPointerPosition()
    {
        $handle = fopen($this->stream, 'rb+');
        fwrite($handle, '1');
        $position = ftell($handle);
        fclose($handle);
        $this->assertEquals(1, $position, 'Invalid pointer position.');
    }

    /**
     * Ensures that fseek() indicates a failure if an invalid pointer
     * position is requested.
     */
    public function testFseekIndicatesFailureIfInvalidOffsetIsPassed()
    {
        $handle = fopen($this->stream, 'rb+');
        $result = fseek($handle, -1);
        fclose($handle);
        $this->assertSame(-1, $result);
    }

    /**
     * Ensures that fseek() moves the pointer correctly if an
     * absolute position is requested.
     */
    public function testFseekMovesPointerToAbsolutePosition()
    {
        $handle = fopen($this->stream, 'rb+');
        fseek($handle, 2);
        $position = ftell($handle);
        fclose($handle);
        $this->assertEquals(2, $position);
    }

    /**
     * Ensures that fseek() indicates a failure if an invalid relative
     * position is requested.
     */
    public function testFseekIndicatesFailureIfInvalidRelativePositionIsRequested()
    {
        $handle = fopen($this->stream, 'rb+');
        $result = fseek($handle, -2 * strlen(self::INITIAL_CONTENT), SEEK_CUR);
        fclose($handle);
        $this->assertSame(-1, $result);
    }

    /**
     * Checks if fseek() moves the pointer to the correct relative position.
     */
    public function testFseekMovesPointerToRelativePosition()
    {
        $handle = fopen($this->stream, 'rb+');
        // Move the pointer 2 times to ensure, that no absolute positioning is used internally.
        fseek($handle, 2, SEEK_CUR);
        fseek($handle, 2, SEEK_CUR);
        $position = ftell($handle);
        fclose($handle);
        $this->assertEquals(4, $position);
    }

    /**
     * Ensures that fseek() indicates a failure if an invalid position
     * relative to the end of the strem is requested.
     */
    public function testFseekIndicatesFailureIfPositionFromEndIsBeforeStreamStart()
    {
        $handle = fopen($this->stream, 'rb+');
        $result = fseek($handle, -2 * strlen(self::INITIAL_CONTENT), SEEK_END);
        fclose($handle);
        $this->assertSame(-1, $result);
    }

    /**
     * Ensures that positioning the pointer relative to the end of the
     * stream works correctly.
     */
    public function testFseekMovesPointerToPositionFromEnd()
    {
        $handle = fopen($this->stream, 'rb+');
        fseek($handle, -1, SEEK_END);
        $position = ftell($handle);
        fclose($handle);
        $this->assertEquals(strlen(self::INITIAL_CONTENT) - 1, $position);
    }

    /**
     * Ensures that fseek() moves the pointer to the end of the stream
     * if a position beyond stream end is requested.
     */
    public function testFseekMovesPointerToEndIfPositionBeyondStreamEndIsRequested()
    {
        $handle = fopen($this->stream, 'rb+');
        fseek($handle, 5000);
        $position = ftell($handle);
        fclose($handle);
        $this->assertEquals(strlen(self::INITIAL_CONTENT), $position);
    }

    /**
     * Ensures that fseek() indicates success if the pointer was positioned
     * successfully.
     */
    public function testFseekIndicatesSuccessIfPositionWasChangedSuccessfully()
    {
        $handle = fopen($this->stream, 'rb+');
        $result = fseek($handle, 1);
        fclose($handle);
        $this->assertSame(0, $result);
    }

    /**
     * Ensures that fseek() indicates success if a pointer position beyond
     * end of stream is requested.
     */
    public function testFseekIndicatesSuccessIfPositionBeyondStreamEndIsProvided()
    {
        $handle = fopen($this->stream, 'rb+');
        $result = fseek($handle, 5000);
        fclose($handle);
        $this->assertSame(0, $result);
    }

    /**
     * Checks if opening the stream in write mode truncates the existing content.
     */
    public function testOpeningStreamInWriteModeTruncatesContent()
    {
        $handle = fopen($this->stream, 'wb');
        fclose($handle);
        $this->assertEquals('', $this->stream->getContent());
    }

    /**
     * Tests if appending content in "a" mode works correctly.
     */
    public function testAppendingContentWorksCorrectly()
    {
        $handle = fopen($this->stream, 'ab');
        fwrite($handle, 'appended');
        fclose($handle);
        $expected = self::INITIAL_CONTENT . 'appended';
        $this->assertEquals($expected, $this->stream->getContent());
    }

    /**
     * Checks if writing in the middle of the stream works correctly.
     */
    public function testWritingIntoTheStreamWorksCorrectly()
    {
        $handle = fopen($this->stream, 'ab');
        fseek($handle, strlen('Hello '));
        fwrite($handle, 'Europe');
        fclose($handle);
        $this->assertEquals('Hello Europe', $this->stream->getContent());
    }

    /**
     * Ensures that an exception is thrown if a stream identifier of
     * a destroyed stream object is used.
     */
    public function testAccessingDestroyedStreamsThrowsAnException()
    {
        $this->setExpectedException('RuntimeException');
        $identifier = (string)$this->stream;
        // Destroy the stream.
        $this->stream = null;
        file_get_contents($identifier);
    }

    /**
     * Checks if fstat() returns information about the stream size.
     */
    public function testFstatReturnsSizeInformation()
    {
        $handle = fopen($this->stream, 'rb+');
        $info   = fstat($handle);
        fclose($handle);
        $this->assertType('array', $info);
        $expectedSize = strlen(self::INITIAL_CONTENT);
        $this->assertArrayHasKey(7, $info, 'Missing numerical key.');
        $this->assertArrayHasKey('size', $info, 'Missing associative key.');
        $this->assertEquals($expectedSize, $info[7]);
        $this->assertEquals($expectedSize, $info['size']);
    }

    /**
     * Ensures that is_file() returns true if the stream identifier is passed.
     */
    public function testIsFileReturnsTrueIfStreamObjectIsPassed()
    {
        $this->assertTrue(is_file($this->stream));
    }

    /**
     * Ensures that is_file() returns false if the stream object is already destroyed.
     */
    public function testIsFileReturnsFalseIfStreamDoesNotExistAnymore()
    {
        $identifier   = (string)$this->stream;
        $this->stream = null;
        $this->assertFalse(is_file($identifier));
    }

    /**
     * Ensures that file_exists() returns true if a stream object is passed.
     */
    public function testFileExistsReturnsTrueIfStreamObjectIsPassed()
    {
        $this->assertTrue(file_exists($this->stream));
    }

    /**
     * Ensures that file_exists() returns false if the stream object is already destroyed.
     */
    public function testFileExistsReturnsFalseIfStreamDoesNotExistAnymore()
    {
        $identifier   = (string)$this->stream;
        $this->stream = null;
        $this->assertFalse(file_exists($identifier));
    }

    /**
     * Ensures that is_readable() returns true if a stream object is passed.
     */
    public function testIsReadableReturnsTrueIfStreamObjectIsPassed()
    {
        $this->assertTrue(is_readable($this->stream));
    }

    /**
     * Ensures that is_writable() returns true if a stream object is passed.
     */
    public function testIsWritableReturnsTrueIfStreamObjectIsPassed()
    {
        $this->assertTrue(is_writable($this->stream));
    }

    /**
     * Ensures that is_executable() returns false if a stream object is passed.
     */
    public function testIsExecutableReturnsFalseIfStreamObjectIsPassed()
    {
        $this->assertFalse(is_executable($this->stream));
    }

    /**
     * Checks if filesize() returns the correct size of the stream.
     */
    public function testFilesizeReturnsCorrectStreamSize()
    {
        $size = filesize($this->stream);
        $this->assertEquals(strlen(self::INITIAL_CONTENT), $size);
    }

}

