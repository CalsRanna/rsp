<?php

namespace Cals\RSPArchitecture\Commands;

use Illuminate\Console\Command;

/**
 * Class MakePresenter
 *
 * @package Cals\RSPArchitecture\Commands
 */
class MakePresenter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:presenter {presenter}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new presenter class';

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
        $presenter = $this->argument('presenter');
        $array = explode('/', $presenter);
        $presenter = array_pop($array);
        $path = app_path() . '/Presenters/';
        $namespace = 'App\\Presenters';
        foreach ($array as $item) {
            $path = $path . $item . '/';
            $namespace = $namespace . '\\' . $item;
        }
        $this->createDirectories($path);
        $this->createInterface($path, $namespace, $presenter);
        $this->createImplementation($path, $namespace, $presenter);
        $this->info('Presenter created successfully.');
    }

    /**
     * Create directories.
     *
     * @param $path
     */
    private function createDirectories($path)
    {
        if (!is_dir($path . 'Interfaces/')) {
            $interface = $path . 'Interfaces/';
            mkdir($interface, 0777, true);
        }
        if (!is_dir($path . 'Implementations/')) {
            $implementations = $path . 'Implementations/';
            mkdir($implementations, 0777, true);
        }
    }

    /**
     * Create the interface.
     *
     * @param $path
     * @param $namespace
     * @param $presenter
     */
    private function createInterface($path, $namespace, $presenter)
    {
        $file = fopen($path . 'Interfaces/' . $presenter . 'Interface.php', 'w');
        $content = "<?php\n\n"
            . "namespace " . $namespace . "\\Interfaces;\n\n\n"
            . "interface " . $presenter . "Interface\n"
            . "{\n"
            . "    // Put your code here...\n"
            . "}\n";
        fwrite($file, $content);
        fclose($file);
    }

    /**
     * Create the implementation.
     *
     * @param $path
     * @param $namespace
     * @param $presenter
     */
    private function createImplementation($path, $namespace, $presenter)
    {
        $presenter = $this->calculateModel($presenter);
        $file = fopen($path . 'Implementations/' . $presenter . '.php', 'w');
        $content = "<?php\n\n"
            . "namespace " . $namespace . "\\Implementations;\n\n\n"
            . "use " . $namespace . "\\Interfaces\\" . $presenter . "Interface;\n"
            . "use Cals\\RSPArchitecture\\Presenters\\Implementations\\Presenter;\n\n"
            . "class " . $presenter . " extends Presenter implements " . $presenter . "Interface\n"
            . "{\n"
            . "    // Put your code here...\n"
            . "}\n";
        fwrite($file, $content);
        fclose($file);
    }

    /**
     * Calculate the model.
     *
     * @param $presenter
     * @return string
     */
    private function calculateModel($presenter)
    {
        $length = count($presenter) - 9;
        return substr($presenter, 0, $length - 1);
    }
}
