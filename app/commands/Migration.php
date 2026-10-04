<?php

class Migration
{
    public static $command = 'migration';
    public static $description = 'Run database migrations';
    public static $arguments = [
        '[action]' => 'Action: run, create-migration, rollback, rollback-all, refresh, status',
        '[name]' => 'Migration class name for create-migration',
    ];

    protected static $route_map = [
        'run' => 'migrate',
        'create-migration' => 'create-migration',
        'rollback' => 'rollback',
        'rollback-all' => 'rollback-all',
        'refresh' => 'refresh',
        'status' => 'status',
    ];

    public function handle($action = null, array $flags = [])
    {
        $action = $action ?: 'run';
        if (!isset(static::$route_map[$action])) {
            echo danger("Unknown migration action: \"{$action}\"");
            echo 'Available actions: ' . implode(', ', array_keys(static::$route_map)) . PHP_EOL;
            exit(1);
        }

        if ($action === 'create-migration') {
            $name = $flags['name'] ?? ($GLOBALS['argv'][3] ?? null);
            if (!$name) {
                echo danger('Migration name is required.');
                echo 'Example: php lava migration create-migration create_users_table' . PHP_EOL;
                exit(1);
            }
            if (!preg_match('/^[a-z][a-z0-9_]*$/i', $name)) {
                echo danger('Migration name may contain only letters, numbers, and underscores.');
                exit(1);
            }
            $route = 'create-migration/' . $name;
        } else {
            $route = static::$route_map[$action];
        }

        $root = dirname(__DIR__, 2);
        $index = $root . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'index.php';
        if (!file_exists($index)) {
            echo danger("public/index.php not found at: {$index}");
            exit(1);
        }

        $command = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($index) . ' ' . escapeshellarg($route);
        passthru($command, $exit_code);
        exit($exit_code);
    }
}