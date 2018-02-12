## WINGCA Admin 
### 相关
PHP >= 5.5.9

框架：[Laravel 5.1](https://laravel.com/docs/5.1)
[中文文档](https://d.laravel-china.org/docs/5.1)

前端：[AdminLTE](https://adminlte.io/themes/AdminLTE/index2.html)

### 安装

0.克隆这个项目(推荐使用SSH)
`git clone https or ssh address`

1.安装相关的依赖
`composer install`

2.复制修改或者创建 并配置 .env 文件
`cp .env.example .env`

3.生成应用key
`php artisan key:generate`

4.运行迁移
`php artisan migrate`

5.数据填充
`php artisan db:seed`
### 使用
后台访问：`localhost/admin`

默认账号：
```
admin@wingca.com
admin
```

### 功能
默认集成：菜单管理，用户管理，角色管理