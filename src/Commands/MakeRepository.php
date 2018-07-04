<?php

namespace Cals\RSP\Commands;

use Illuminate\Console\Command;

/**
 * Class MakeRepository
 *
 * @package Cals\RSP\Commands
 */
class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Create a new command instance.
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
        $repository = $this->argument('repository');
        $array = explode('/', $repository);
        $repository = array_pop($array);
        $path = app_path() . '/Repositories/';
        $namespace = 'App\\Repositories';
        foreach ($array as $item) {
            $path = $path . $item . '/';
            $namespace = $namespace . '\\' . $item;
        }
        $this->createDirectories($path);
        $this->createInterface($path, $namespace, $repository);
        $this->createImplementation($path, $namespace, $repository);
        $this->info('Repository created successfully.');
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
     * @param $repository
     */
    private function createInterface($path, $namespace, $repository)
    {
        $fileName = $path . 'Interfaces/' . $repository . 'Interface.php';
        if (!file_exists($fileName)) {
            $file = fopen($path . 'Interfaces/' . $repository . 'Interface.php', 'w');
            $content = "<?php\n\n"
                . "namespace " . $namespace . "\\Interfaces;\n\n"
                . "interface " . $repository . "Interface\n"
                . "{\n"
                . "    // Put your code here...\n"
                . "}\n";
            fwrite($file, $content);
            fclose($file);
        }
    }

    /**
     * Create the implementation.
     *
     * @param $path
     * @param $namespace
     * @param $repository
     */
    private function createImplementation($path, $namespace, $repository)
    {
        $model = $this->calculateModel($repository);
        $fileName = $path . 'Implementations/' . $repository . '.php';
        if (!file_exists($fileName)) {
            $file = fopen($path . 'Implementations/' . $repository . '.php', 'w');
            $content = "<?php\n\n"
                . "namespace " . $namespace . "\\Implementations;\n\n"
                . "use App\\Models\\" . $model . ";\n"
                . "use " . $namespace . "\\Interfaces\\" . $repository . "Interface;\n"
                . "use Cals\\RSP\\Repositories\\Implementations\\Repository;\n\n"
                . "class " . $repository . " extends Repository implements " . $repository . "Interface\n"
                . "{\n"
                . "    /**\n"
                . "     * Get the full name of model.\n"
                . "     *\n"
                . "     * @return mixed\n"
                . "     */\n"
                . "    function model()\n"
                . "    {\n"
                . "        return " . $model . "::class;\n"
                . "    }\n\n"
                . "    // Put your code here...\n"
                . "}\n";
            fwrite($file, $content);
            fclose($file);
        }
    }

    /**
     * Calculate the model.
     * @param $repository
     * @return string
     */
    private function calculateModel($repository)
    {
        return substr($repository, 0, strlen($repository) - 10);
    }
}
