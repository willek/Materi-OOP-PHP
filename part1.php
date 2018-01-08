<?php

/**
 * Materi:
 * 1. Pengenalan Object Oriented Programming PHP
 * 2. Apa itu class?
 * 3. Apa itu property?
 * 4. Apa itu method?
 * 5. Instansiasi class.
 * 6. T_OBJECT_OPERATOR.
 * 7. Instance dan variable $this.
 * 8. Inheritance.
 * 9. Mengenal visibilitas public, private dan protected.
 * 10. Static.
 * 11. Keyword self, parent dan static.
 * 12. T_PAAMAYIM_NEKUDOTAYIM.
 * 13. Singleton pattern.
 **/

 // Pengenalan OOP
 // https://id.wikipedia.org/wiki/Pemrograman_berorientasi_objek

 //Class (Pondasi dari sebuah object)
 class Restoran {
   //Property (Apapun yang dimiliki oleh sebuah class)
   public $pengunjung = 10;

   //Method (Apapun yang dapat dilakukan oleh sebuah class)
   function buka(){
     print "Restoran dibuka";
   }

 }

/**
 * Instansiasi sebuah class (Keyword: new).
 * Instansiasi class adalah membuat sebuah object dari class
 * Contoh:
 * new Restoran;
 **/

 // Inisialisasi / Menampung object yang dibuat dengan class restoran ke dalam variable $restoran
 $restoran = new Restoran;

/**
 * Untuk mengetahui awal mula sebuah object terbentuk dari class apa, maka dapat kita gunakan function get_class.
 * Function ini sudah bawaan dari PHP sendiri.
 * Dia akan me-return sebuah string, dan string tersebut adalah nama class yang membentuk object tersebut.
 * Contoh:
 * echo get_class($restoran);
 * Output: Restoran
 **/

/**
 * T_OBJECT_OPERATOR.
 * T_OBJECT_OPERATOR adalah simbol untuk mengakses property dan method pada sebuah object.
 * -> (seperti ini bentuknya).
 *
 * Contoh penggunaan T_OBJECT_OPERATOR pada property.
 * echo $restoran->pengunjung;
 * Output: 10.
 * Dari contoh diatas, saya menggunakan T_OBJECT_OPERATOR untuk mengakses proprty.
 * Namun, T_OBJECT_OPERATOR juga dapat digunakan untuk set property.
 * Contoh:
 * $restoran->nama = 'Restoran Hijau';
 * echo $restoran->nama;
 * Output: Restoran Hijau.
 * Disini saya menambahkan property nama.
 * $restoran->nama = 'Restoran Hijau';
 * Pada deklarasi inilah sebuah property baru (nama) terbentuk.
 *
 * Contoh penggunaan T_OBJECT_OPERATOR pada method.
 * Untuk mengakses sebuah method pada class hal yang harus kita lakukan tidak jauh beda dengan mengakses property.
 * Kita hanya perlu menambahkan tanda () dalam pemanggilannya. Seperti halnya kita melakukan pemanggilan function prosedural.
 * Contoh:
 * $restoran->buka();
 * Output: Restoran dibuka.
 *
 * Lalu apa yang terjadi apabila kita mengakses sebuah property atau method yang tidak terdeklarasi pada sebuah object?.
 * Apabila kita mengakses undeclared property pada sebuah object maka PHP akan menampiklan E_NOTICE dengan pesan Undefined Property.
 * Hal tersebut tidak terlalu berpengaruh pada program apabila tidak ada error handling yang mematikan proses ketika E_NOTICE di-throwkan oleh PHP.
 * Contoh:
 * echo $restoran->manajer;
 * echo '\ntest';
 * Output:
 * test
 * (error di console)
 * PHP Notice:  Undefined property: Restoran::$manajer in E:\Project\OOP\part1.php on line ..
 * Disini saya mengakses property manajer, padahal dalam object tersebut tidak ada property manajer,
 * sehingga PHP akan memberikan E_NOTICE Undefined property. Walaupun tampak ada peringatan, akan tetapi program masih berjalan,
 * hal ini terbukti dengan adanya tulisan test dalam outputnya.
 *
 * Untuk tindakan preventif menghindari E_NOTICE kalau kita memiliki class yang sudah sangat rumit,
 * maka hendaknya kita melakukan checking dengan isset.
 * Contoh:
 * if (isset($restoran->manajer)) {
 *  echo 'manajer';
 * }
 * echo 'test';
 * Output:
 * test
 *
 * Tampak tidak ada E_NOTICE yang dimunculkan oleh PHP. Karena disini kita sudah membuat perintah untuk melakukan checking terhadap sebuah property.
 * Maksud dari potongan code diatas adalah, code yang akan dijalankan dalam lingkup curly braces { }  atau yang sering kita sebut dengan kurung kurawal
 * yang ada setelah statement if-nya hanya akan dijalankan apabila property manajer pada object restoran telah di deklarasikan. Itulah yang dinamakan preventif.
 **/

 ?>
