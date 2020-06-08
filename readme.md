# Weather Forecast Website App #

## Tentang Projek Ini ##
Proyek ini adalah salah satu contoh aplikasi sederhana prakiraan cuaca menggunakan bahasa pemrograman [PHP](https://secure.php.net/) dengan framework [Laravel](https://laravel.com/) dan [MetaWeather](https://www.metaweather.com) sebagai penyedia API data pihak ketiga untuk data prakiraan cuaca. Tidak ada konfigurasi pada database.

### Halaman Pada Aplikasi ###
Pada aplikasi ini terdapat dua halaman, yaitu halaman index/ home dan halaman dashboard.

Untuk halaman index/ home digunakan untuk menampilkan data prakiraan cuaca pada hari ini hingga lima hari ke depan. Pada halaman ini juga terdapat kolom pencarian nama kota di seluruh dunia dan yang terdapat pada database MetaWeather tentunya. Secara default, untuk tampilan awal akan menampilkan prakiraan cuaca untuk Kota Jakarta, Indonesia.

Pada halaman kedua yaitu halaman dashboard, adalah untuk menampilkan data kota apa saja yang pernah dicari, status kota yang pernah dicari dan total hit untuk masing-masing kota. Data tersebut tersimpan dalam sebuah file json bernama `city.json`

## Instalasi ##
Perlu diketahui, saat saya mengembangkan aplikasi ini, pada komputer saya menggunakan PHP versi 7.0.30 dan menggunakan server Apache 2.0.

Untuk versi Laravel ini sendiri yaitu menggunakan framework Laravel versi 5.5. Untuk penggunaan minimum pada Laravel versi 5.5 bisa dilihat pada tautan berikut: [link](https://laravel.com/docs/5.5/#installation).

### Proses Instalasi ###
* Clone project ini pada komputer anda ke dalam direktori website anda, contohnya `/Library/WebServer/Documents/`
* Setelah proses cloning berhasil, buka terminal untuk masuk ke dalam direktori website anda, contohnya: `cd /Library/WebServer/Documents/weather-forecast`
* Lakukan install dependensi framework Laravel melalui composer melalui terminal dengan perintah `composer install`, atau apabila muncul error atau pesan tidak berhasil lakukan dengan perintah `composer install --no-scripts`
* Setelah itu, masih dalam terminal yang sama, masukkan command untuk copy file .env.example menjadi .env dengan cara `cp .env.example .env`
* Jalankan perintah `php artisan key:generate`
* Setelah proses instalasi selesai, buka browser anda dengan memasukkan alamat http://localhost/weather-forecast/public/, atau menggunakan virtual host sesuai settingan anda.
* Apabila ada pesan error karena tidak bisa membuka file stream, berikan permission full access pada direktori web project anda, contoh: `chmod -R 777 weather-forecast/`

## Cara Kerja Aplikasi ##
Pada saat awal anda menjalankan aplikasi ini, anda akan berada pada halaman index, pada halaman ini anda akan ditampilkan prakiraan cuaca hari ini hingga lima hari ke depan. Data tersebut diperoleh dari API yang disediakan oleh [MetaWeather](https://www.metaweather.com/api/). Lalu, data kota yang tampil pada halaman tersebut disimpan di dalam sebuah file JSON bernama `city.json`. File tersebut berada pada direktori `<WEB_DIR>/weather-forecast/storage/app/public/`. Data dalam file tersebut berbentuk JSON.

Lalu, ketika anda melakukan pencarian pada kolom pencarian, data prakiraan cuaca akan muncul, namun apabila data kota yang anda cari tidak tersedia, maka halaman website akan menampilkan sebuah alert yang mengindikasikan data yang anda cari tidak ditemukan.

Ketika anda membuka pada halaman dashboard, maka akan muncul data kota apa saja yang pernah dicari. Data tersebut berisi daftar kota, status dan total hits. Data dalam tabel tersebut ditampilkan sesuai pada file `<WEB_DIR>/weather-forecast/storage/app/public/city.json`, atau data kota apa saja yang pernah anda cari.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
