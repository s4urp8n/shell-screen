<?php

use Zver\ShellScreen;

class ShellScreenTest extends PHPUnit\Framework\TestCase
{

    use \Zver\Package\Helper;

    public function testComplete()
    {

        $alreadyExistedScreens = ShellScreen::getList();

        $getActualScreens = function () use ($alreadyExistedScreens) {

            $list = ShellScreen::getList();

            foreach ($list as $key => $value) {
                if (in_array($value, $alreadyExistedScreens)) {
                    unset($list[$key]);
                }
            }

            return array_values($list);

        };


        /**
         * initially empty
         */
        $this->assertSame([], $getActualScreens());

        /**
         * run first screen
         */
        ShellScreen::run('testtest1', 'sleep 3');
        $this->assertSame(['testtest1'], $getActualScreens());

        /**
         * run second screen
         */
        ShellScreen::run('testtest2', 'sleep 3');
        $this->assertSame([
            'testtest1',
            'testtest2'
        ], $getActualScreens());

        /**
         * sleep to check that screens is still working
         */
        sleep(8);

        $this->assertSame([
            'testtest1',
            'testtest2'
        ], $getActualScreens());

        /**
         * quit runned screens
         */

        ShellScreen::quit('testtest1');
        ShellScreen::quit('testtest2');

        /**
         * must be empty list
         */
        $this->assertSame([], $getActualScreens());

    }

}