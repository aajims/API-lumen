<?php

if ( ! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     *
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('mklog')) {
    /**
     * Create log directory.
     *
     * @param string|null $dir
     *
     * @return string
     */
    function mklog($dir = null)
    {
        $y = date('Y');
        $m = date('m');
        $d = date('d');
        $a = date('a') . '.log';
        $format = $dir ? 'logs/%s/%s/%s/' . $dir : 'logs/%s/%s/%s';
        $path = sprintf($format, $y, $m, $d);
        $path = storage_path($path);
        $filesystem = new \Symfony\Component\Filesystem\Filesystem();

        try {
            if ( ! $filesystem->exists($path)) {
                $filesystem->mkdir($path);
            }
        } catch (\Symfony\Component\Filesystem\Exception\IOException $e) {
            echo $e->getMessage();
        }

        return $path . '/' . $a;
    }
}
