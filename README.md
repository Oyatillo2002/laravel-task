<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Proyekt

Bu loyiha menejer va mijozlarni bog'laydi \
Mijozlar o'z arizalarini qoldiradi \
Menejer esa arizalarni o'qib ularga javob qaytaradi
### Loyihada quyidagilar bilan ishlandi:
- Answers
- Applications
- Migrations
- Roles \
Loyihada 2ta rol bor:
  1. manager
  2. client
- Models
- Mail \
Ariza yaratilganda email yuboriladi va logga saqlanadi
- Seeders \
Loyihada quyidagi seederlar bor:
  1. Answer
  2. Application
  3. Role
  4. User

## Loyihani ishga tushirish
```
 composer install
 ```
 - .env faylini sozlash
   1. Databaseni sozlash
   2. MAIL_MAILER=log 
   
 ```
 npm install
 npm run dev
 php artisan key:generate
 php artisan migrate --seed
 php artisan queue:work
 php artisan serve
```
## Foydalanuvchi
1. Manager: \
   User: manage@company.com \
   Password: secret 
2. Client: \
   User: client@company.com \
   Password: secret
   

## Ma'lumotlar bazasi  Strukturasi
![Database](database.png "Database")

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
