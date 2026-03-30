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
