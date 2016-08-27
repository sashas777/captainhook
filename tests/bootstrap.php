<?php
/**
 * This file is part of HookMeUp.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('HMU_PATH_FILES', realpath(__DIR__ . '/files'));
define('HMU_TEST_RUN', true);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/HookMeUp/Git/DummyRepo.php';
require __DIR__ . '/HookMeUp/Runner/BaseTestRunner.php';
