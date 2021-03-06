<?php
namespace Test\Hal\Formater\Summary;

use Hal\Bounds\Bounds;
use Hal\Bounds\DirectoryBounds;
use Hal\Bounds\Result\BoundsResult;
use Hal\Formater\Summary\Cli;
use Symfony\Component\Console\Output\ConsoleOutput;


/**
 * @group formater
 */
class CliTest extends \PHPUnit_Framework_TestCase {

    public function testFormaterReturnsHtml() {

        $rs1 = $this->getMockBuilder('\Hal\Result\ResultSet')->disableOriginalConstructor()->getMock();
        $rs1->expects($this->any())->method('asArray')->will($this->returnValue(array('volume' => 5)));
        $rs2 = $this->getMockBuilder('\Hal\Result\ResultSet')->disableOriginalConstructor()->getMock();
        $rs2->expects($this->any())->method('asArray')->will($this->returnValue(array('volume' => 15)));

        $collection = $this->getMockBuilder('\Hal\Result\ResultCollection') ->disableOriginalConstructor() ->getMock();
        $collection->expects($this->any()) ->method('getIterator') ->will($this->returnValue(new \ArrayIterator(array($rs1, $rs2))));
        $collection->expects($this->any()) ->method('asArray') ->will($this->returnValue(array(
                array('volume' => 5)
                , array('volume' => 10)
            )));
        $collection->expects($this->any()) ->method('getFilename') ->will($this->returnValue('abc'));

        $validator = $this->getMockBuilder('\Hal\Rule\Validator')->disableOriginalConstructor()->getMock();

        $bounds = new Bounds();
        $agregatedBounds = new DirectoryBounds(0);
        $formater = new Cli($validator, $bounds, $agregatedBounds);
        $output = $formater->terminate($collection);
        $this->assertRegExp('/Maintenability/', $output);
    }

    public function testFormaterHasName() {
        $validator = $this->getMockBuilder('\Hal\Rule\Validator')->disableOriginalConstructor()->getMock();
        $bounds = new Bounds();
        $agregatedBounds = new DirectoryBounds(0);
        $formater = new Cli($validator, $bounds, $agregatedBounds);
        $this->assertNotNull($formater->getName());
    }
}