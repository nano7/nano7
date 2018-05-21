<?php namespace Nano7\Support;

class Filesystem extends \Illuminate\Filesystem\Filesystem
{
    /**
     * @param $path1
     * @param $path2
     * @param null $pathn
     * @return string
     */
    public function combine($path1, $path2, $pathn = null)
    {
        $args = func_get_args();

        $path = '';
        foreach ($args as $arg) {
            $path .= ($path != '') ? DIRECTORY_SEPARATOR  : '';
            $path .= $arg;
        }

        return $path;
    }
}