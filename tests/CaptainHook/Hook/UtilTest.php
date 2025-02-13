<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CaptainHook\App\Hook;

use PHPUnit\Framework\TestCase;
use RuntimeException;

class UtilTest extends TestCase
{
    /**
     * Tests Util::isValid
     */
    public function testIsValid(): void
    {
        $this->assertTrue(Util::isValid('pre-commit'));
        $this->assertTrue(Util::isValid('pre-push'));
        $this->assertTrue(Util::isValid('commit-msg'));
        $this->assertFalse(Util::isValid('foo'));
    }

    /**
     * Tests Util::getValidHooks
     */
    public function testGetValidHooks(): void
    {
        $this->assertArrayHasKey('pre-commit', Util::getValidHooks());
        $this->assertArrayHasKey('pre-push', Util::getValidHooks());
        $this->assertArrayHasKey('commit-msg', Util::getValidHooks());
    }

    /**
     * Tests Util::getHookCommand
     *
     * @dataProvider providerValidCommands
     *
     * @param string $class
     * @param string $hook
     */
    public function testGetHookCommandValid(string $class, string $hook): void
    {
        $this->assertEquals($class, Util::getHookCommand($hook));
        $this->assertEquals('PreCommit', Util::getHookCommand('pre-commit'));
        $this->assertEquals('PrepareCommitMsg', Util::getHookCommand('prepare-commit-msg'));
        $this->assertEquals('PrePush', Util::getHookCommand('pre-push'));
    }

    /**
     * @return array
     */
    public function providerValidCommands(): array
    {
        return [
            ['CommitMsg', 'commit-msg'],
            ['PreCommit', 'pre-commit'],
            ['PrepareCommitMsg', 'prepare-commit-msg'],
            ['PrePush', 'pre-push'],
        ];
    }

    /**
     * Tests Util::getHookCommand
     *
     * @dataProvider providerInvalidCommands
     */
    public function testGetHookCommandInvalid(string $hook): void
    {
        $this->expectException(RuntimeException::class);

        $this->assertEquals('', Util::getHookCommand($hook));
    }

    /**
     * @return array
     */
    public function providerInvalidCommands(): array
    {
        return [
            [''],
            ['foo'],
        ];
    }

    /**
     * Tests Util::getHooks
     */
    public function testGetHooks(): void
    {
        $this->assertContains('pre-commit', Util::getHooks());
        $this->assertContains('pre-push', Util::getHooks());
        $this->assertContains('commit-msg', Util::getHooks());
    }
}
