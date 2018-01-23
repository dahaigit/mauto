# laravel

## 项目拉下来以后，安装方法

```
1、配置homestead.yaml
    - map: mauto.com
      to: /home/vagrant/code/mauto/public
    配置env文件（数据库）
    配置host(域名)
2、部署项目
    vagrant provision
3、进入hometead 安装项目依赖
    composer install

