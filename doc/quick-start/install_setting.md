# Install & Setting

[PHP中文手册](https://www.php.net/manual/zh/)



## VSCode开发环境配置

+ 下载xampp, 安装

+ VSCode Manage -> Settings -> Extensions -> PHP -> Edit in settings.json

  ```properties
  "php.validate.executablePath": "/opt/lampp/bin/php",
  "php.executablePath": "/opt/lampp/bin/php",
  ```

+ 安装PHP VSCode插件
  + PHP Debug
  + PHP Intelephense
  + Live Server
  + ......

+ 测试

  + PHP执行原理

    PHP是一种HTML 内嵌式脚本语言；

  

## PhpStorm 开发环境配置

貌似 PhpStorm 只认 /usr/bin/php，php安装到其他目录的话，需要创建一个 /usr/bin/php的软链接。