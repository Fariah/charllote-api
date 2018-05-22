<?php

namespace App\Jobs;

use App\Code;
use Illuminate\Http\Request;

class ParseCodesJob extends Job
{
    protected $code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Code $code)
    {
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {

    }
}
