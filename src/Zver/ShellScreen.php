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
            static::checkInstalled();

            if (static::isScreenExists($name)) {
                throw new \Exception("Screen with name " . $name . ' already exists');
            }

            $format = 'screen -dmS "%s" bash -c \'%s\'';

            if (is_array($command)) {
                $command = implode(';', $command);
            }

            $cmd = sprintf($format, $name, $command);

            shell_exec($cmd);
        }

        public static function quit($name)
        {
            static::checkInstalled();

            if (static::isScreenExists($name)) {

                $format = 'screen -X -S "%s" quit';

                $cmd = sprintf($format, $name);

                shell_exec($cmd);
            }
        }

        protected static function checkInstalled()
        {
            if (!static::isScreenInstalled()) {
                throw new \Exception('Screen command is not available');
            }
        }

        public static function isScreenExists($name)
        {
            $list = static::getList();

            return in_array($name, $list);
        }

        public static function getList()
        {

            static::checkInstalled();

            $list = [];

            $output = $exitcode = '';

            @exec('screen -ls', $output, $exitcode);

            foreach ($output as $line) {

                $line = StringHelper::load($line)->trimSpaces();

                if ($line->isPregMatch('#^\d+\.\w+ \(\w+\)$#i')) {
                    $list[] = $line->setFirstPart(' ')->getLastPart('.');
                }
            }

            if (!empty($list)) {
                sort($list);
            }

            return $list;
        }

    }
}
