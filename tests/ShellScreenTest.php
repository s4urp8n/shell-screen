<?php

class ShellScreenTest extends PHPUnit\Framework\TestCase
{

    use \Zver\Package\Helper;

    public function testComplete()
    {
        /**
         * initially empty
         */
        $this->assertSame([], \Zver\ShellScreen::getList());

        /**
         * run first screen
         */
        \Zver\ShellScreen::run('testtest1', 'sleep 3');
        $this->assertSame(['testtest1'], \Zver\ShellScreen::getList());

        /**
         * run second screen
         */
        \Zver\ShellScreen::run('testtest2', 'sleep 3');
        $this->assertSame([
            'testtest1',
            'testtest2'
        ], \Zver\ShellScreen::getList());

        /**
         * sleep to check that screens is still working
         */
        sleep(8);

        $this->assertSame([
            'testtest1',
            'testtest2'
        ], \Zver\ShellScreen::getList());

        /**
         * quit runned screens
         */

        \Zver\ShellScreen::quit('testtest1');
        \Zver\ShellScreen::quit('testtest2');

        /**
         * must be empty list
         */
        $this->assertSame([], \Zver\ShellScreen::getList());

    }

}