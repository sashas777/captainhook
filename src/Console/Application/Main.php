<?php
/**
 * This file is part of HookMeUp.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace HookMeUp\Console\Application;

use HookMeUp\HMU;
use HookMeUp\Console\Application;
use HookMeUp\Console\Command;

/**
 * Class Main
 *
 * @package HookMeUp
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/sebastianfeldmann/hookmeup
 * @since   Class available since Release 0.9.0
 */
class Main extends Application
{
    /**
     * Application constructor.
     */
    public function __construct()
    {
        if (function_exists('ini_set') && extension_loaded('xdebug')) {
            ini_set('xdebug.show_exception_trace', false);
            ini_set('xdebug.scream', false);
        }
        parent::__construct('HookMeUp', HMU::VERSION);
    }

    /**
     * Initializes all the hookmeup commands.
     *
     * @return array
     */
    protected function getDefaultCommands()
    {
        $commands = array_merge(
            parent::getDefaultCommands(),
            [
                new Command\Configure(),
                new Command\Install(),
                new Command\Run(),
            ]
        );
        return $commands;
    }
}
