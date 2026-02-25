# PKL

![example workflow](https://github.com/msyamf/pkl2022/actions/workflows/ssh.yml/badge.svg)
 
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

## diperlukan

| APP | Download |
| ------ | ------ |
| Composer | https://getcomposer.org/ | 
| MySql | https://www.mysql.com/ | 
|PHP||


### Clone project
`https://github.com/msyamf/pkl2022.git`
```sh
git clone https://github.com/msyamf/pkl2022.git  
```
edit file koneksi `.ENV`

```code 
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=la3
DB_USERNAME=syam
DB_PASSWORD=syam 
...
```


## Development

```sh
composer install
php artisan migrate
php artisan serve
```

### registrasi
http://localhost:8000/register


setelah selesai register ubah role pada colom `role` tabel `users` sesuai kebutuhan

| role | Keterangan |
| ------ | ------ |
| 1 | Admin | 
| 2 | user atau member | 
| 3 | mentor |




