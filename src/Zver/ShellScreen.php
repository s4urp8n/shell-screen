<?php

namespace Zver {


    class ShellScreen
    {

        public static function isScreenInstalled()
        {

            $output = $exitcode = '';

            @exec('screen -v 2>&1', $output, $exitcode);

            $output = StringHelper::load($output);

            return $output->isPregMatch('#screen\s+version#i');

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
