<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_PLATFORM.'/joomla/application/pathway.php';

/**
 * General inspector class for JPathway.
 *
 * @package Joomla.UnitTest
 * @subpackage HTML
 * @since 11.3
 */
class JPathwayInspector extends JPathway
{
	/**
	* Method for inspecting protected variables.
	*
	* @return mixed The value of the class variable.
	*/
	public function __get($name)
	{
		if (property_exists($this, $name)) {
			return $this->$name;
		} else {
			trigger_error('Undefined or private property: ' . __CLASS__.'::'.$name, E_USER_ERROR);
			return null;
		}
	}

	/**
	* Sets any property from the class.
	*
	* @param string $property The name of the class property.
	* @param string $value The value of the class property.
	*
	* @return void
	*/
	public function __set($property, $value)
	{
		$this->$property = $value;
	}

	/**
	 * Calls any inaccessible method from the class.
	 *
	 * @param string 	$name Name of the method to invoke
	 * @param array 	$parameters Parameters to be handed over to the original method
	 *
	 * @return mixed The return value of the method
	 */
	public function __call($name, $parameters = false)
	{
		return call_user_func_array(array($this, $name), $parameters);
	}
}

/**
 * Test class for JPathway.
 * Generated by PHPUnit on 2009-10-08 at 12:50:04.
 */
class JPathwayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test JPathway::__construct().
	 */
	public function test__construct()
	{
		$class = new JPathwayInspector();
		$this->assertThat(
			$class->_pathway,
			$this->equalTo(array())
		);
	}
	
	/**
	 * @todo Implement testGetInstance().
	 */
	public function testGetInstance()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	/**
	 * Test JPathway::getPathway().
	 */
	public function testGetPathway()
	{
		$class = new JPathwayInspector();
		$class->addItem('Item1', 'index.php?key=item1');
		$class->addItem('Item2', 'index.php?key=item2');
		
		$pathway = array();
		$object1 = new stdClass();
		$object1->name = 'Item1';
		$object1->link = 'index.php?key=item1';
		$pathway[] = $object1;
		$object2 = new stdClass();
		$object2->name = 'Item2';
		$object2->link = 'index.php?key=item2';
		$pathway[] = $object2;
		
		$this->assertThat(
			$class->getPathway(),
			$this->equalTo($pathway)
		);
	}

	/**
	 * Test JPathway::setPathway().
	 */
	public function testSetPathway()
	{
		$class = new JPathwayInspector();
		
		$pathway = array();
		$object1 = new stdClass();
		$object1->name = 'Item1';
		$object1->link = 'index.php?key=item1';
		$pathway[2] = $object1;
		$object2 = new stdClass();
		$object2->name = 'Item2';
		$object2->link = 'index.php?key=item2';
		$pathway[4] = $object2;
		
		$this->assertThat(
			$class->setPathway($pathway),
			$this->equalTo(array())
		);
		
		$this->assertThat(
			$class->_pathway,
			$this->equalTo(array_values($pathway))
		);
		
		$this->assertThat(
			$class->setPathway(array()),
			$this->equalTo(array_values($pathway))
		);
		
		$this->assertThat(
			$class->_pathway,
			$this->equalTo(array())
		);
	}

	/**
	 * Test JPathway::getPathwayNames().
	 */
	public function testGetPathwayNames()
	{
		$class = new JPathwayInspector();
		
		$pathway = array();
		$object1 = new stdClass();
		$object1->name = 'Item1';
		$object1->link = 'index.php?key=item1';
		$pathway[] = $object1;
		$object2 = new stdClass();
		$object2->name = 'Item2';
		$object2->link = 'index.php?key=item2';
		$pathway[] = $object2;
		
		$class->_pathway = $pathway;
		
		$this->assertThat(
			$class->getPathwayNames(),
			$this->equalTo(array('Item1', 'Item2'))
		);
	}

	/**
	 * Test JPathway::addItem().
	 */
	public function testAddItem()
	{
		$class = new JPathwayInspector();
		
		$pathway = array();
		$object1 = new stdClass();
		$object1->name = 'Item1';
		$object1->link = 'index.php?key=item1';
		$pathway[] = $object1;
		$object2 = new stdClass();
		$object2->name = 'Item2';
		$object2->link = 'index.php?key=item2';
		$pathway[] = $object2;
		
		$class->addItem('Item1', 'index.php?key=item1');
		$class->addItem('Item2', 'index.php?key=item2');
		
		$this->assertThat(
			$class->_pathway,
			$this->equalTo($pathway)
		);
	}

	/**
	 * Test JPathway::setItemName().
	 */
	public function testSetItemName()
	{
		$class = new JPathwayInspector();
		
		$pathway = array();
		$object1 = new stdClass();
		$object1->name = 'Item1';
		$object1->link = 'index.php?key=item1';
		$pathway[] = $object1;
		$object2 = new stdClass();
		$object2->name = 'Item2';
		$object2->link = 'index.php?key=item2';
		$pathway[] = $object2;
		
		$class->_pathway = $pathway;
		
		$this->assertTrue(
			$class->setItemName(1, 'Item3')
		);
		
		$pathway[1]->name = 'Item3';
		$this->assertThat(
			$class->_pathway,
			$this->equalTo($pathway)
		);
		
		$this->assertFalse(
			$class->setItemName(3, 'False')
		);
		
		$this->assertThat(
			$class->_pathway,
			$this->equalTo($pathway)
		);
	}

	/**
	 * Test JPathway::_makeItem().
	 */
	public function test_makeItem()
	{
		$class = new JPathwayInspector();
		
		$object = new stdClass();
		$object->link = 'index.php?key=value1';
		$object->name = 'Value1';
		
		$this->assertThat(
			$class->_makeItem('Value1', 'index.php?key=value1'),
			$this->equalTo($object)
		);
	}
}
