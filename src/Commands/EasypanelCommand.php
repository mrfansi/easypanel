<?php

namespace Mrfansi\Easypanel\Commands;

use Illuminate\Console\Command;

class EasypanelCommand extends Command
{
    public $signature = 'easypanel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
