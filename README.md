# Filament CMS
Laravel + Filament V5 CMS

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
