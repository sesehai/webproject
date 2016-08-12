<?php
$config = array(
    '_modelsHome' => ROOT_PATH . '/models',
    '_controllersHome' => ROOT_PATH . '/controllers',
    '_configHome' => ROOT_PATH . '/conf',
);
/**
 * 加载配置文件
 */

foreach (glob($config['_configHome'] . '/*') as $item) {
    is_file($item) && require ($item);
}
