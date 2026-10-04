<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class MigrationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!defined('IS_CLI') || !IS_CLI) {
            show_404();
        }

        $this->call->library('migration');
    }

    public function create_migration($migration_class)
    {
        if (!preg_match('/^[a-z][a-z0-9_]*$/i', $migration_class)) {
            show_error('Migration name may contain only letters, numbers, and underscores.');
        }
        $this->migration->create_migration($migration_class);
    }

    public function migrate()
    {
        $this->migration->migrate();
    }

    public function rollback()
    {
        $this->migration->rollback();
    }

    public function rollback_all()
    {
        $this->migration->rollback_all();
    }

    public function refresh()
    {
        $this->migration->refresh();
    }

    public function status()
    {
        $this->migration->status();
    }
}