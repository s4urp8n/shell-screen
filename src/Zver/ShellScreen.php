<?php

namespace Zver {


    class ShellScreen
    {

        public static function isScreenInstalled()
        {

        }

        public static function run($name, $command)
        {

            $format = 'screen -dmS "%s" bash -c \'%s\'';

            $cmd = sprintf($format, $name, $command);

            shell_exec($cmd);
        }

        public static function quit($name)
        {

            $format = 'screen -X -S "%s" quit';

            $cmd = sprintf($format, $name);

            shell_exec($cmd);
        }

        public static function getList()
        {

        }

    }
}
