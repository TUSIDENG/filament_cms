# Filament CMS
Laravel + Filament V5 CMS

## 功能
* Filament提供了一组开发包，可以让后端轻松开发管理面板，未提供用户中心功能

## todo
* 安装一个插件，并使用
* 创建post模型,并且可以利用filament管理面板进行管理,并且利用filament资源提供一个对外的列表和详情页

## Troubleshooting

### Static Resources Repeatedly Loading
memory cache 可以忽略这个问题

### Application timeline too long
* Filament 很重，导致应用时间过长

* 单独接口形式，laravel也比thinkphp慢

## 加速应用
加速后，性能提升明显，从十几秒二十秒，降到了几秒甚至一秒内。
```bash
php artisan octane:start --host=0.0.0.0 --port=9001
```

启用octane后nginx配置如下:
```nginx
server {
    listen 0.0.0.0:80;
    server_name laravel.test;
    root /var/www/filament_cms/public;
    index index.php index.html index.htm;

    # 上传文件大小限制
    client_max_body_size 100M;

    # 静态资源缓存
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|woff|woff2|ttf|svg|eot|otf|webp|mp4|webm|ogg|mp3|wav|flv|swf|txt|pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar|7z|tar|gz)$ {
        expires 7d;
        add_header Cache-Control "public, max-age=604800";
        add_header Access-Control-Allow-Origin *;
        try_files $uri =404;
    }

    # 代理到laravel octane应用
    location / {
        try_files $uri $uri/ @octane;
    }

    # 代理到octane
    # @octane 代理到php-fpm:9001
    location @octane {
        proxy_pass http://php-fpm:9001;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header Connection "";
        proxy_read_timeout 300s;
        proxy_send_timeout 300s;
        proxy_connect_timeout 75s;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php-fpm:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(env|git|svn|ht|ssh) {
        deny all;
    }

    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }

    error_log /var/log/nginx/laravel_error.log;
    access_log /var/log/nginx/laravel_access.log;
}
```
