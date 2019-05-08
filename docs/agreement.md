# 此文档为该项目的开发约定

## 命名

## 变量命名
开发语言|变量名|类名
-|-|-|
PHP| 下划线命名法|大驼峰法
JS|  小驼峰法|大驼峰法

### 别名

对于部分变量的命名使用别名，其他全部使用全称。

原名|别名|
-|-|
problem_id|pid
user_id|uid
contest_id|cid



## 项目结构&说明

- [app](#app)
    - Console
    - Events
    - Exceptions
    - Handlers
    - Http
       - Controllers
       - Middleware
       - Requests
       - Kernel.php
    - Models
    - Notifications
    - Observers
    - Policies
    - Providers
    - help_function.php
- [bootstrap](#)
- [config](#)
- [database](#)
    - factories
    - migrations
    - seeds
- [docs](#)
- [public](#)
- [resources](#)
    - assets
        - js
            - components
            - router
            - store
            - app.js
            - bootstrap.js
        - stylus
            -app.styl
    - lang
- [routes](#)
- [storage](#)
- [tests](#)
- [以下其他文件](#以下其他文件)
    - .env
    - .env.example
    - .gitignore
    - artisan
    - readme.md
    - package.json
    - composer.json
    - wabpack.mix.js
    - server.php


### 根目录

#### app

包含Controller、Model、url路由等在内的应用目录，大部分业务将在该目录下进行

文件(夹)|描述
-|-|
Console|命令行程序目录
Events|事件目录
Exceptions|包含了自定义错误和异常处理类
Handlers|事件处理目录
Http|
Http/Controllers|控制器
Http/Middleware|中间件
Http/Requests|请求模型
Http/Kernel.php|
Models|
Notifications|
Observers|监听器目录
Policies|验证权限规则
Providers|服务提供者目录
help_function.php|

#### bootstrap

框架启动与自动加载设置相关的文件

文件(夹)|描述
-|-|
app.php |创建框架应用实例
cache   |存放框架启动缓存，web服务器需要有该目录的写入权限

#### config

各种配置文件的目录
文件|描述
-|-|
app.php  |  系统级配置文件
auth.php   | 用户身份认证配置文件，指定好table和model就可以很方便地用身份认证功能了
broadcasting.php|    事件广播配置文件
cache.php   | 缓存配置文件
compile.php  |  编译额外文件和类需要的配置文件，一般用户很少用到
database.php  |  数据库配置文件
filesystems.php |   文件系统配置文件，这里可以配置云存储参数
mail.php  |  电子邮件配置文件
queue.php  |  消息队列配置文件
services.php |   可存放第三方服务的配置信息
session.php  |  配置session的存储方式、生命周期等信息
view.php   | 模板文件配置文件，包含模板目录和编译目录等

#### database
文件(夹)|描述
-|-|
factories|工厂类
migrations|存储数据库迁移文件
seeds| 存放数据填充类的目录

#### docs
文件(夹)|描述
-|-|
agreement.md|开发约定
database.md|数据库表情况
todo.md|后续开发计划

#### public
网站入口，应当将ip或域名指向该目录而不是根目录。可供外部访问的css、js和图片等资源皆放置于此
文件(夹)|描述
-|-|
fonts|
uploads|
favicon.ico|
index.php|
robots.txt|
web.config|IIS服务器用该文件重写URL
#### resources

文件(夹)|描述
-|-|
assets|可存放包含LESS、SASS、CoffeeScript在内的原始资源文件
assets/js|
assets/stylus|
lang| 本地化文件目录
views| 视图文件

#### routes
文件(夹)|描述
-|-|
api.php|
channels.php|
console.php|
web_api.php|
web.php|

#### storage
存储目录。web服务器需要有该目录及所有子目录的写入权限
文件(夹)|描述
-|-|
app|
debugbar|
framework|目录下包括缓存、sessions和编译后的视图文件
logs| 日志目录

#### tests
测试目录

#### 其他文件
文件(夹)|说明
-:|-:|
.env|环境配置文件。config目录下的配置文件会使用该文件里面的参数，不同生产环境使用不同的.env文件即可。
.env.example |样例环境配置文件文件
.gitignore|你想要忽略的文件或者目录
artisan    |强大的命令行接口，你可以在app/Console/Commands下编写自定义命令
readme.md|
package.json|
composer.json|存放依赖关系的文件
webpack.mix.js|
server.php| PHP内置的Web服务器将把这个文件作为入口。以public/index.php为入口的可以忽略掉该文件

