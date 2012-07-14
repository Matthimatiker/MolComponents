<?php

/**
 * Mol_Validate_SuffixTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 28.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Suffix validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 28.06.2012
 */
class Mol_Validate_SuffixTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Suffix
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Suffix(array('.txt', '.dat'));
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->validator = null;
        parent::tearDown();
    }
    
    /**
     * Checks if getSuffixes() returns an array.
     */
    public function testGetSuffixesReturnsArray()
    {
        $suffixes = $this->validator->getSuffixes();
        $this->assertInternalType('array', $suffixes);
    }
    
    /**
     * Checks if getSuffixes() returns the correct number of suffixes.
     */
    public function testGetSuffixesReturnsCorrectNumberOfSuffixes()
    {
        $suffixes = $this->validator->getSuffixes();
        $this->assertInternalType('array', $suffixes);
        $this->assertEquals(2, count($suffixes));
    }
    
    /**
     * Checks if getSuffixes() returns the correct suffixes.
     */
    public function testGetSuffixesReturnsCorrectSuffixes()
    {
        $suffixes = $this->validator->getSuffixes();
        $this->assertInternalType('array', $suffixes);
        $this->assertContains('.txt', $suffixes);
        $this->assertContains('.dat', $suffixes);
    }
    
    /**
     * Checks if setSuffixes() provides a fluent interface.
     */
    public function testSetSuffixesProvidesFluentInterface()
    {
        $this->assertSame($this->validator, $this->validator->setSuffixes(array('.png')));
    }
    
    /**
     * Ensures that setSuffixes() overwrites the current suffixes.
     */
    public function testSetSuffixesOverwritesCurrentSuffixes()
    {
        $this->validator->setSuffixes(array('.png'));
        $suffixes = $this->validator->getSuffixes();
        $this->assertInternalType('array', $suffixes);
        $this->assertNotContains('.txt', $suffixes);
        $this->assertNotContains('.dat', $suffixes);
    }
    
    /**
     * Checks if setSuffixes() sets the provided suffixes.
     */
    public function testSetSuffixesSetsNewSuffixes()
    {
        $this->validator->setSuffixes(array('.png', '.gif'));
        $suffixes = $this->validator->getSuffixes();
        $this->assertInternalType('array', $suffixes);
        $this->assertContains('.png', $suffixes);
        $this->assertContains('.gif', $suffixes);
    }
    
    /**
     * Ensures that the validator rejects values of invalid type.
     */
    public function testIsValidRejectsInvalidValue()
    {
        $this->assertFalse($this->validator->isValid(new stdClass()));
    }
    
    /**
     * Checks if isValid() accepts a value with an allowed suffix.
     */
    public function testIsValidAcceptsValueWithAllowedSuffix()
    {
        $this->assertTrue($this->validator->isValid('test.txt'));
    }
    
    /**
     * Ensures that isValid() accepts a value that ends with a suffix from
     * the end of the suffixes list.
     */
    public function testIsValidAcceptsValueWithSuffixFromEndOfList()
    {
        $this->assertTrue($this->validator->isValid('test.dat'));
    }
    
    /**
     * Ensures that the validator rejects a value without accepted suffix.
     */
    public function testIsValidRejectsValueWithoutAcceptedSuffix()
    {
        $this->assertFalse($this->validator->isValid('invalid.jpg'));
    }
    
    /**
     * Ensures that isValid() accepts all string if the list of suffixes
     * is empty.
     */
    public function testIsValidAcceptsValueIfListOfAcceptedSuffixesIsEmpty()
    {
        $this->validator->setSuffixes(array());
        $this->assertTrue($this->validator->isValid('image.jpg'));
    }
    
    /**
     * Ensures that the validator provides a failure message if a value
     * of invalid type is provided.
     */
    public function testValidatorProvidesMessageIfInvalidValueIsProvided()
    {
        $this->validator->isValid(new stdClass());
        $this->assertFailureMessage();
    }
    
    /**
     * Ensures that the validator provides a failure message if a value without
     * accepted suffix is provided.
     */
    public function testValidatorProvidesMessageIfValueWithoutAcceptedSuffixIsProvided()
    {
        $this->validator->isValid('invalid.jpg');
        $this->assertFailureMessage();
    }
    
    /**
     * Checks if the allowedSuffixes property contains the allowed suffixes.
     */
    public function testAllowedSuffixesPropertyContainsStringRepresentationOfAllowedSuffixes()
    {
        $list = $this->validator->allowedSuffixes;
        $this->assertInternalType('string', $list);
        $this->assertContains('.txt', $list);
        $this->assertContains('.dat', $list);
    }
    
    /**
     * Checks if the magic "value" property still contains the correct value.
     */
    public function testValuePropertyContainsCorrectValue()
    {
        $this->validator->isValid('invalid.jpg');
        $this->assertEquals('invalid.jpg', $this->validator->value);
    }
    
    /**
     * Ensures that the constructor throws an exception if a suffixes parameter of
     * invalid type is passed.
     */
    public function testConstructorThrowsExceptionIfInvalidSuffixParameterIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Mol_Validate_Suffix(new stdClass());
    }
    
    /**
     * Checks if the constructor accepts a single suffix (string parameter).
     */
    public function testConstructorAcceptsSingleSuffix()
    {
        $this->validator = new Mol_Validate_Suffix('.jpg');
        $suffixes = $this->validator->getSuffixes();
        $this->assertEquals(array('.jpg'), $suffixes);
    }
    
    /**
     * Asserts that the validator provides at least one failure message.
     */
    protected function assertFailureMessage()
    {
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
}
