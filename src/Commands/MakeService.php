<?php

namespace Cals\RSPArchitecture\Commands;

use Illuminate\Console\Command;

/**
 * Class MakeService
 *
 * @package Cals\RSPArchitecture\Commands
 */
class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

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
        $service = $this->argument('service');
        $array = explode('/', $service);
        $service = array_pop($array);
        $path = app_path() . '/Services/';
        $namespace = 'App\\Services';
        foreach ($array as $item) {
            $path = $path . $item . '/';
            $namespace = $namespace . '\\' . $item;
        }
        $this->createDirectories($path);
        $this->createInterface($path, $namespace, $service);
        $this->createImplementation($path, $namespace, $service);
        $this->info('Service created successfully.');
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
     * @param $service
     */
    private function createInterface($path, $namespace, $service)
    {
        $fileName = $path . 'Interfaces/' . $service . 'Interface.php';
        if (!file_exists($fileName)) {
            $file = fopen($path . 'Interfaces/' . $service . 'Interface.php', 'w');
            $content = "<?php\n\n"
                . "namespace " . $namespace . "\\Interfaces;\n\n"
                . "interface " . $service . "Interface\n"
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
     * @param $service
     */
    private function createImplementation($path, $namespace, $service)
    {
        $repository = $this->calculateRepository($namespace, $service);
        $prefix = $this->calculatePrefix($service);
        $fileName = $path . 'Implementations/' . $service . '.php';
        if (!file_exists($fileName)) {
            $file = fopen($path . 'Implementations/' . $service . '.php', 'w');
            $content = "<?php\n\n"
                . "namespace " . $namespace . "\\Implementations;\n\n"
                . "use App\\Repositories\\" . $repository . "RepositoryInterface;\n"
                . "use " . $namespace . "\\Interfaces\\" . $service . "Interface;\n"
                . "use Cals\\RSPArchitecture\\Services\\Implementations\\Service;\n\n"
                . "class " . $service . " extends Service implements " . $service . "Interface\n"
                . "{\n"
                . "    /**\n"
                . "     * " . $service . " constructor.\n"
                . "     *\n"
                . "     * @param " . $prefix . "RepositoryInterface \$repository\n"
                . "     */\n"
                . "    public function __construct(" . $prefix . "RepositoryInterface \$repository)\n"
                . "    {\n"
                . "        \$this->repository = \$repository;\n"
                . "    }\n\n"
                . "    // Put your code here...\n"
                . "}\n";
            fwrite($file, $content);
            fclose($file);
        }
    }

    /**
     * Calculate the model.
     *
     * @param $service
     * @return string
     */
    private function calculateRepository($namespace, $service)
    {
        $array = explode('\\', $namespace);
        array_splice($array, 0, 2);
        $namespace = null;
        foreach ($array as $item) {
            $namespace = $namespace . $item . '\\';
        }
        return $namespace . 'Interfaces\\' . $this->calculatePrefix($service);
    }

    /**
     * Calculate the prefix.
     *
     * @param $service
     * @return string
     */
    private function calculatePrefix($service)
    {
        $length = count($service) - 7;
        return substr($service, 0, $length - 1);
    }
}
