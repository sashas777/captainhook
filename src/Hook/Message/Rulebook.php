<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CaptainHook\Hook\Message;

use CaptainHook\Config;
use CaptainHook\Console\IO;
use CaptainHook\Git\Repository;

/**
 * Class Rulebook
 *
 * @package CaptainHook
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/sebastianfeldmann/captainhook
 * @since   Class available since Release 0.9.0
 */
class Rulebook extends Base
{
    /**
     * Execute the configured action.
     *
     * @param  \CaptainHook\Config         $config
     * @param  \CaptainHook\Console\IO     $io
     * @param  \CaptainHook\Git\Repository $repository
     * @param  \CaptainHook\Config\Action  $action
     * @throws \CaptainHook\Exception\ActionExecution
     */
    public function execute(Config $config, IO $io, Repository $repository, Config\Action $action)
    {
        $rules     = $action->getOptions();
        $validator = new Validator();
        foreach ($rules as $class) {
            $validator->addRule($this->createRule($class));
        }
        $this->executeValidator($validator, $repository);
    }

    /**
     * Create a new rule.
     *
     * @param  string $class
     * @return \CaptainHook\Hook\Message\Validator\Rule
     * @throws \Exception
     */
    protected function createRule($class)
    {
        // make sure the class is available
        if (!class_exists($class)) {
            throw new \Exception('Unknown rule: ' . $class);
        }

        $rule = new $class();

        // make sure the class implements the Rule interface
        if (!$rule instanceof Validator\Rule) {
            throw new \Exception('Class \'' . $class . '\' must implement the Rule interface');
        }

        return $rule;
    }
}
