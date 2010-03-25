<?php
#
# Import some changes to CakeWebTest so that this
# works with selenium
#
require_once('cozyextentions/cozywebtest.php');

class LoginWebTestCase extends CozyWebTestCase{
	
	public function testLogin(){
		
		$this->selenium->open('/');
	  $this->selenium->click("link=Login");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertTrue($this->selenium->isTextPresent("Username"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Password"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("exact:Forgot Your Password?"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("exact:Want To Register?"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->selenium->type("UserUsername", "user");
    $this->selenium->type("UserPassword", "password");
    $this->selenium->click("//input[@value='Login']");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertTrue($this->selenium->isTextPresent("Puzzles"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("My Solutions"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("My Puzzles"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("user"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Logout"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->selenium->click("link=Logout");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertTrue($this->selenium->isTextPresent("Login"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Register"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->selenium->open("/");
    $this->assertTrue($this->selenium->isTextPresent("Login"));
    $this->assertTrue($this->selenium->isTextPresent("Register"));
  }

	public function testRegister(){
		$this->selenium->open("/");
    $this->selenium->open("/users/add");
    $this->assertTrue($this->selenium->isElementPresent("UserAddForm"));
    $this->assertTrue($this->selenium->isElementPresent("//form[@id='UserAddForm']/img"));
    $this->assertTrue($this->selenium->isTextPresent("Username"));
    try {
        $this->assertTrue($this->selenium->isTextPresent("Email"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Password"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->selenium->isTextPresent("Confirm Password"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->assertTrue($this->selenium->isTextPresent("exact:Already A Member?"));
    $this->selenium->type("UserUsername", "testuser");
    $this->selenium->type("UserEmail", "testuser@test.com");
    $this->selenium->type("UserPasswordNew", "password");
    $this->selenium->type("UserPasswordConfirm", "password");
    $this->selenium->type("UserCaptcha", "automatedtest");
    $this->selenium->click("//input[@value='Register']");
    $this->selenium->waitForPageToLoad("3000");
    $this->assertTrue($this->selenium->isElementPresent("link=Logout"));
    $this->assertTrue($this->selenium->isElementPresent("link=testuser"));
    $this->assertTrue($this->selenium->isTextPresent("Puzzles"));
    $this->assertTrue($this->selenium->isElementPresent("contentlinks"));
    $this->assertTrue($this->selenium->isElementPresent("//img[@alt='submit topic']"));
    $this->selenium->click("link=Logout");
    $this->selenium->waitForPageToLoad("3000");
    $this->assertTrue($this->selenium->isElementPresent("link=Login"));
    $this->assertTrue($this->selenium->isElementPresent("link=Register"));
	}
	
	public function testChangeEmail(){
		$this->selenium->open("/");
    $this->selenium->click("link=Login");
    $this->selenium->waitForPageToLoad("3000");
    $this->selenium->type("UserUsername", "user");
    $this->selenium->type("UserPassword", "password");
    $this->selenium->click("//input[@value='Login']");
    $this->selenium->waitForPageToLoad("3000");
    $this->selenium->click("link=user");
    $this->selenium->waitForPageToLoad("3000");
    $this->assertTrue($this->selenium->isElementPresent("//form[@id='UserEditForm']/div[1]/label"));
    $this->assertTrue($this->selenium->isElementPresent("link=Change Password"));
    try {
        $this->assertEquals("user@mail.com", $this->selenium->getValue("UserEmail"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->selenium->type("UserEmail", "usertest@gmail.com");
    $this->selenium->click("//input[@value='Save']");
    $this->selenium->waitForPageToLoad("3000");
    $this->assertTrue($this->selenium->isElementPresent("//img[@alt='submit topic']"));
    $this->assertTrue($this->selenium->isElementPresent("link=user"));
    $this->selenium->click("link=user");
    $this->selenium->waitForPageToLoad("3000");
    try {
        $this->assertEquals("usertest@gmail.com", $this->selenium->getValue("UserEmail"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
	}
	
	public function testChangePassword(){
		$this->selenium->open('/');
		$this->selenium->click("link=Login");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->type("UserUsername", "user");
		$this->selenium->type("UserPassword", "password");
		$this->selenium->click("//input[@value='Login']");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=user");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=Change Password");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->type("UserPasswordCurrent", "password");
		$this->selenium->type("UserPasswordNew", "newpassword");
		$this->selenium->type("UserPasswordConfirm", "newpassword");
		$this->selenium->click("//input[@value='Save']");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=Logout");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=Login");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->type("UserUsername", "user");
		$this->selenium->type("UserPassword", "newpassword");
		$this->selenium->click("//input[@value='Login']");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=user");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=Change Password");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->type("UserPasswordCurrent", "newpassword");
		$this->selenium->type("UserPasswordNew", "password");
		$this->selenium->type("UserPasswordConfirm", "password");
		$this->selenium->click("//input[@value='Save']");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=Logout");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=Login");
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->type("UserUsername", "user");
		$this->selenium->type("UserPassword", "password");
		$this->selenium->click("//input[@value='Login']");
		$this->selenium->waitForPageToLoad("3000");
		 try {
        $this->assertTrue($this->selenium->isTextPresent("user"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
		$this->selenium->waitForPageToLoad("3000");
		$this->selenium->click("link=Logout");
	}
	
}
?>