<?php
require_once('cozyextentions/cozywebtest.php');

class TopicsWebTestCase extends CozyWebTestCase{
	
	public function testSubmitEditTopic(){
		$this->selenium->open("/");
    $this->selenium->click("link=Login");
    $this->selenium->waitForPageToLoad("3000");
    $this->selenium->type("UserUsername", "user");
    $this->selenium->type("UserPassword", "password");
    $this->selenium->click("//input[@value='Login']");
    $this->selenium->waitForPageToLoad("3000");
    $this->selenium->click("//img[@alt='submit topic']");
    $this->selenium->waitForPageToLoad("3000");
    $this->selenium->type("TopicTitle", "test puzzle");
    $this->selenium->type("TopicText", "puzzle");
    $this->selenium->click("DataStructureDataStructure1");
    $this->selenium->click("AlgorithmAlgorithm4");
    $this->selenium->type("TopicCaptcha", "automatedtest");
    $this->selenium->click("//input[@value='Submit your topic']");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertTrue($this->selenium->isTextPresent("1 point | by user | edit"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->selenium->click("link=test puzzle");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertTrue($this->selenium->isTextPresent("test puzzle by user"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->assertTrue($this->selenium->isElementPresent("selectedtopic"));
    $this->assertTrue($this->selenium->isElementPresent("link=edit"));
    try {
        $this->assertTrue($this->selenium->isTextPresent("Related Algorithms: Combinatorial"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Related Datastructures: Arrays"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->selenium->click("link=edit");
    $this->selenium->waitForPageToLoad("3000");
    $this->selenium->type("TopicTitle", "test puzzle edit");
    $this->selenium->type("TopicText", "puzzle edit");
    $this->selenium->click("DataStructureDataStructure3");
    $this->selenium->click("AlgorithmAlgorithm7");
    $this->selenium->click("//input[@value='Submit your topic']");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertTrue($this->selenium->isTextPresent("test puzzle edit by user"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("puzzle edit"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Related Algorithms: Combinatorial, String Manipulation"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Related Datastructures: Arrays, Trees"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->selenium->click("link=Logout");
    $this->selenium->waitForPageToLoad("3000");
    $this->selenium->click("upvoteimg1");
    $this->selenium->waitForPageToLoad("3000");
    $this->assertTrue($this->selenium->isElementPresent("UserAddForm"));
    $this->selenium->click("logo");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertTrue($this->selenium->isTextPresent("1 point | by user"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
	}
	
	public function testVoteTopic(){
		$this->selenium->open("/");
		$this->selenium->click("link=Login");
		$this->selenium->waitForPageToLoad("50000");
		$this->selenium->type("UserUsername", "user");
		$this->selenium->type("UserPassword", "password");
		$this->selenium->click("//input[@value='Login']");
		$this->selenium->waitForPageToLoad("50000");
		$this->selenium->click("//img[@alt='submit topic']");
		$this->selenium->waitForPageToLoad("50000");
		$this->selenium->type("TopicTitle", "test puzzle 1");
		$this->selenium->type("TopicText", "test puzzle 1");
		$this->selenium->click("DataStructureDataStructure1");
		$this->selenium->click("AlgorithmAlgorithm4");
		$this->selenium->type("TopicCaptcha", "automatedtest");
		$this->selenium->click("//input[@value='Submit your topic']");
		$this->selenium->waitForPageToLoad("50000");
		$this->assertTrue($this->selenium->isTextPresent("1 point | by user | edit"));
		$this->selenium->click("downvoteimg1");
		$this->assertTrue($this->selenium->isTextPresent("0 points | by user | edit"));
		$this->selenium->click("logo");
		$this->selenium->waitForPageToLoad("50000");
		$this->assertTrue($this->selenium->isTextPresent("-1 point | by user | edit"));
		$this->selenium->click("upvoteimg1");
		$this->selenium->click("logo");
		$this->selenium->waitForPageToLoad("50000");
		$this->assertTrue($this->selenium->isTextPresent("1 point | by user | edit"));
		$this->selenium->click("link=Logout");
		$this->selenium->waitForPageToLoad("50000");
		$this->assertTrue($this->selenium->isTextPresent("1 point | by user"));
		$this->selenium->click("upvoteimg1");
		$this->selenium->waitForPageToLoad("50000");
		$this->assertTrue($this->selenium->isElementPresent("UserAddForm"));
		$this->selenium->click("logo");
		$this->selenium->waitForPageToLoad("50000");
		$this->selenium->click("downvoteimg1");
		$this->selenium->waitForPageToLoad("50000");
		$this->assertTrue($this->selenium->isElementPresent("register"));
		$this->selenium->click("logo");
		$this->selenium->waitForPageToLoad("50000");
		$this->assertTrue($this->selenium->isTextPresent("test puzzle 1"));
		$this->selenium->click("logo");
		$this->selenium->waitForPageToLoad("50000");
	}
}
?>