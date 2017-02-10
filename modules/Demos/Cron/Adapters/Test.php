<?php

namespace Modules\Demos\Cron\Adapters;

use Plugins\Cron\Adapter;


class Test extends Adapter
{
    protected $name = 'CRON Test';

    /**
     * Execute the CRON operations.
     */
    public function handle()
    {
        return 'Hello from the CRON!';
    }

}
