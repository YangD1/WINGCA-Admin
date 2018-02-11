## WINGCA Admin 
0.克隆这个项目
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
