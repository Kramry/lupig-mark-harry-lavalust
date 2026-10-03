<?php
/**
 * Command: Migration
 *
 * Auto-discovered by the LavaLust CLI.
 * No registration needed — just drop this file in app/commands/.
 */
class Migration
{
    /**
     * The CLI command name.
     * Usage: php lava migration
     */
    public static $command = 'migration';

    /** Short description shown in php lava help */
    public static $description = 'Description for migration';

    /**
     * Argument/flag descriptions shown in help.
     *
     * Example:
     *   public static $arguments = [
     *       'name'        => 'A positional argument',
     *       '[--flag=<v>]' => 'An optional flag',
     *   ];
     */
    public static $arguments = [];

    /**
     * Command entry point.
     *
     * @param string|null $input   First positional argument (php lava migration <input>)
     * @param array       $flags   Associative array of --flag=value pairs
     */
    public function handle($input = null, array $flags = [])
    {
        // TODO: Add your command logic here
        echo "Running Migration..." . PHP_EOL;
    }
}