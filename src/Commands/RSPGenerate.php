<?php

namespace Cals\RSPArchitecture\Commands;

use Illuminate\Console\Command;

/**
 * Class RSPGenerate
 *
 * @package Cals\RSPArchitecture\Commands
 */
class RSPGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rsp:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the missing repositories, services and presenters based on registration';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $repositories = config('rsp.repositories');
        $services = config('rsp.services');
        $presenters = config('rsp.presenters');
        foreach ($repositories as $repository) {
            $array = explode('\\', $repository);
            $suffix = array_splice($array,3);
            $repository = implode('/',$suffix);
            $this->callSilent('make:repository',[
                'repository' => $repository
            ]);
        }
        foreach ($services as $service) {
            $array = explode('\\', $service);
            $suffix = array_splice($array,3);
            $repository = implode('/',$suffix);
            $this->callSilent('make:service',[
                'service' => $service
            ]);
        }
        foreach ($presenters as $presenter) {
            $array = explode('\\', $presenter);
            $suffix = array_splice($array,3);
            $repository = implode('/',$suffix);
            $this->callSilent('make:presenter',[
                'presenter' => $presenter
            ]);
        }
        $this->info('Repositories, services and presenters generated successfully.');
    }
}
