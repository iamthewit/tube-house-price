<?php

namespace TubeHousePrice\Application;

class Config
{
    /**
     * Use dot notation to return config values
     *
     * @param $key
     * @return array|mixed|null
     */
    public static function get($key)
    {
        $config = self::build();

        return self::getValueByKey($key, $config);
    }

    /**
     * @return array
     */
    private static function build(): array
    {
        return [
            'paths' => [
                'project_root'      => getenv('PROJECT_ROOT_PATH'),
                'resources'         => getenv('PROJECT_ROOT_PATH') . '/resources',
                'sqlite_database'   => getenv('PROJECT_ROOT_PATH') . '/resources/sqlite/database',
                'sqlite_migrations' => getenv('PROJECT_ROOT_PATH') . '/resources/sqlite/migrations',
            ],
        ];
    }

    /**
     * https://selvinortiz.com/blog/traversing-arrays-using-dot-notation
     *
     * @param $key
     * @param array $data
     * @param null $default
     * @return array|mixed|null
     */
    private static function getValueByKey($key, array $data, $default = null)
    {
        // @assert $key is a non-empty string
        // @assert $data is a loopable array
        // @otherwise return $default value
        if (!is_string($key) || empty($key) || !count($data)) {
            return $default;
        }

        // @assert $key contains a dot notated string
        if (strpos($key, '.') !== false) {
            $keys = explode('.', $key);

            foreach ($keys as $innerKey) {
                // @assert $data[$innerKey] is available to continue
                // @otherwise return $default value
                if (!array_key_exists($innerKey, $data)) {
                    return $default;
                }

                $data = $data[$innerKey];
            }

            return $data;
        }

        // @fallback returning value of $key in $data or $default value
        return array_key_exists($key, $data) ? $data[$key] : $default;
    }
}
