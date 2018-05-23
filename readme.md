# laravel

## 项目拉下来以后，安装方法

```
1、配置homestead.yaml
    - map: mauto.com
      to: /home/vagrant/code/mauto/public
   配置env文件（数据库）
   (1. cp .env.example .env	2.php artisan key:generate)

    配置host(域名)
2、部署项目
    vagrant provision
3、进入hometead 安装项目依赖
    composer install
4.phpStudy host set(DocumentRoot "E:\projects\mauto\public")


# 生产环境配置

```
1、拷贝完后修改对应的数据库以及微信相关的配置
    cp .env.production .env

2、安装PHP依赖组件
    composer install

3、生成密钥
    php artisan key:generate

4、生成微信客户端专用的密码,输入sass_school_api
   php artisan passport:client --password
    
```

