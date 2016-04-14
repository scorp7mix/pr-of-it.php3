<?php

namespace App\Commands;

use T4\Console\Command;

class MemoryTest
{
    public $value;
    public $self;
}

class Memory
    extends Command
{
    public function actionInt()
    {
        $num = 1000000;
        $ints = [];
        $base = memory_get_usage();
        $this->writeLn('Memory usage before: ' . $base . ' bytes');

        $ints = range(1, $num);

        $this->writeLn('Memory usage after: ' . memory_get_usage() . ' bytes');
        $this->writeLn("\n" . 'Memory difference: ' . (memory_get_usage() - $base) . ' bytes');
        $this->writeLn('Approximate memory for one int element in array of ' . $num . ' ints: ' . round((memory_get_usage() - $base) / $num) . ' bytes');

        // PHP7.0: 36bytes for element
        // PHP5.6: 136bytes for element
    }

    private function configMap($level, $path, $obj, &$maxLevel, &$maxPath)
    {
        if ($obj instanceof \T4\Core\Config) {
            $level++;
            $maxLevel = max($level, $maxLevel);
            foreach ($obj as $key => $element) {
                $path[$level] = $key;
                $maxPath = max($path, $maxPath);
                $this->configMap($level, $path, $element, $maxLevel, $maxPath);
            }
        }
    }


    public function actionConfig()
    {
        $maxLevel = 2;
        $maxPath = ['this','app','config'];

        $this->configMap($maxLevel, $maxPath, $this->app->config, $maxLevel, $maxPath);

        $this->writeLn('Maximum config path level: ' . $maxLevel);
        $this->writeLn('Path: ' . implode('->', $maxPath));
    }

    public function actionClass()
    {
        $num = 1000000;
        $base = memory_get_usage();
        $this->writeLn('Memory usage before: ' . $base . ' bytes');

        foreach (range(1, $num) as $i) {
            $objName = 'test' . $i;
            $$objName = new MemoryTest();
            $$objName->value = rand();
            $$objName->self = $$objName;

            if (0 === $i % 500) {
                $this->writeLn('Memory consumption after iteration ' . $i . ': ' . (memory_get_usage() - $base) . ' bytes');
                $this->writeLn('Approximate memory for one object: ' . round((memory_get_usage() - $base) / $i) . ' bytes');
            }
        }

        // PHP7
        // после 500:
        // потребление всего: 35 727 616
        // среднее потребление на объект: 71 455
        // после 1000000:
        // потребление всего: 201 772 344
        // среднее потребление на объект: 202
        // PHP5.6
        // после 500:
        // потребление всего: 136 530 712
        // среднее потребление на объект: 273 061
        // после 1000000:
        // потребление всего: 483 818 560
        // среднее потребление на объект: 484
    }
}
