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

 /**
  * Pengenalan OOP
  * https://id.wikipedia.org/wiki/Pemrograman_berorientasi_objek
  **/

 //Class (Pondasi dari sebuah object)
 class Restoran {
   //Property (Apapun yang dimiliki oleh sebuah class)
   public $pengunjung = 10;

   //Method (Apapun yang dapat dilakukan oleh sebuah class)
   function buka(){
     echo "Restoran dibuka\n";
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
 *
 * echo get_class($restoran);
 *
 * Output: Restoran
 **/

/**
 * T_OBJECT_OPERATOR.
 *
 * T_OBJECT_OPERATOR adalah simbol untuk mengakses property dan method pada sebuah object.
 * -> (seperti ini bentuknya).
 *
 * Contoh penggunaan T_OBJECT_OPERATOR pada property.
 *
 * echo $restoran->pengunjung;
 *
 * Output:
 * 10
 *
 * Dari contoh diatas, saya menggunakan T_OBJECT_OPERATOR untuk mengakses proprty.
 * Namun, T_OBJECT_OPERATOR juga dapat digunakan untuk set property.
 * Contoh:
 *
 * $restoran->nama = 'Restoran Hijau';
 * echo $restoran->nama;
 *
 * Output:
 * Restoran Hijau
 *
 * Disini saya menambahkan property nama.
 * $restoran->nama = 'Restoran Hijau';
 * Pada deklarasi inilah sebuah property baru (nama) terbentuk.
 *
 * Contoh penggunaan T_OBJECT_OPERATOR pada method.
 * Untuk mengakses sebuah method pada class hal yang harus kita lakukan tidak jauh beda dengan mengakses property.
 * Kita hanya perlu menambahkan tanda () dalam pemanggilannya. Seperti halnya kita melakukan pemanggilan function prosedural.
 * Contoh:
 *
 * $restoran->buka();
 *
 * Output:
 * Restoran dibuka
 *
 * Lalu apa yang terjadi apabila kita mengakses sebuah property atau method yang tidak terdeklarasi pada sebuah object?.
 * Apabila kita mengakses undeclared property pada sebuah object maka PHP akan menampiklan E_NOTICE dengan pesan Undefined Property.
 * Hal tersebut tidak terlalu berpengaruh pada program apabila tidak ada error handling yang mematikan proses ketika E_NOTICE di-throwkan oleh PHP.
 * Contoh:
 *
 * echo $restoran->manajer;
 * echo '\ntest';
 *
 * Output:
 * test
 * (error di console)
 * PHP Notice:  Undefined property: Restoran::$manajer in E:\Project\Materi-OOP-PHP\part1.php on line ..
 *
 * Disini saya mengakses property manajer, padahal dalam object tersebut tidak ada property manajer,
 * sehingga PHP akan memberikan E_NOTICE Undefined property. Walaupun tampak ada peringatan, akan tetapi program masih berjalan,
 * hal ini terbukti dengan adanya tulisan test dalam outputnya.
 *
 * Untuk tindakan preventif menghindari E_NOTICE kalau kita memiliki class yang sudah sangat rumit,
 * maka hendaknya kita melakukan checking dengan isset.
 * Contoh:
 *
 * if (isset($restoran->manajer)) {
 *  echo 'manajer';
 * }
 * echo 'test';
 *
 * Output:
 * test
 *
 * Tampak tidak ada E_NOTICE yang dimunculkan oleh PHP. Karena disini kita sudah membuat perintah untuk melakukan checking terhadap sebuah property.
 * Maksud dari potongan code diatas adalah, code yang akan dijalankan dalam lingkup curly braces { }  atau yang sering kita sebut dengan kurung kurawal
 * yang ada setelah statement if-nya hanya akan dijalankan apabila property manajer pada object restoran telah di deklarasikan. Itulah yang dinamakan preventif.
 *
 * Apa yang terjadi apabila method yang tidak defined pada sebuah object diakses? Hal yang terjadi adalah Fatal Error. Fatal Error akan menghentikan jalannya program.
 * Contoh:
 *
 * $restoran->tutup();
 *
 * Output:
 * (error di console)
 * PHP Fatal error: Uncaught Error: Call to undefined method Resoran::tutup() in E:\Project\Materi-OOP-PHP\part1.php:..
 *
 * Disini terjadi Fatal Error karena mengakses sebuah method yang tidak terdefinisi pada sebuah object.
 * Apabila suatu ketika kita dihadapkan dengan kasus seperti ini maka tindakan preventif apa yang harus kita lakukan untuk mencegah terjadinya Fatal Error?
 * Solusinya ada 2.
 * Pertama: pengecekan method menggunakan function is_callable.
 * is_callable sendiri adalah sebuah function yang akan mereturn boolean true apabila parameternya diberi sesuatu yang invokeable.
 *
 * if (is_callable([$restoran, "tutup"])) {
 *    $restoran->tutup();
 * }
 * echo "test\n";
 *
 * Output:
 * test
 *
 * Disini tampak tidak ada error sama sekali.
 * Karena memang pada alur programnya tidak menjalankan method yang undefined. Hal tersebut berkat adanya tidakan preventif dari is_callable.
 *
 * Kedua: try and catch
 * Pada PHP Versi 7 ke atas semua Fatal Error di-throw-kan oleh sebuah class bawaan PHP yang dinamakan class Error.
 * Kita dapat menangkap class tersebut dengan try and catch.
 * Contoh:
 *
 * try {
 *  $restoran->tutup();
 * } catch (Error $e) {
 *  echo get_class($e);
 * }
 *
 * Output:
 * Error
 *
 * Alur dari try and catch pada code tersebut :
 * 1. Code dalam lingkup try (dibatasi oleh curly braces atau kurung kurawal) dijalankan.
 * 2. Pada catch Error maksudnya adalah menangkap object dari class Error apabila sebuah
 *    object tersebut di-thrown-kan pada lingkup try.
 * 3. Pada lingkup catch (dibatasi oleh curly braces atau kurung kurawal) dijalankan
 *    apabila telah menangkap sebuah object dari class Error.
 **/

 /**
  * Instance dan variable $this
  *
  * Instance
  * Dalam PHP, instance adalah nama lain dari sebuah object.
  * Contoh:
  *
  * $restoran = new Restoran;
  *
  * Dalam hal ini, variable $restoran adalah sebuah object yang terbentuk dari class Restoran.
  * Maka dapat disebut "$restoran adalah instance dari restoran".
  * Untuk mengecek apakah $restoran adalah sebuah instance dari restoran, dapat kita gunakan keyword instanceof.
  * Contoh:
  *
  * if ($restoran instanceof Restoran) {
  *   echo "variable \$restoran adalah instance dari Restoran\n";
  * } else {
  *   echo "variable \$restoran bukan instance dari Restoran\n";
  * }
  *
  * Output:
  * variable $restoran adalah instance dari Restoran
  *
  * '$restoran instanceof Restoran' bernilai true, apabila $restoran adalah object yang dibentuk dari class Restoran.
  *
  * Variable $this
  * Variable $this adalah sebuah variable yang spesial. Variable tersebut adalah variable yang hanya dapat digunakan di dalam method sebuah class.
  * Apabila kita menggunakan variable $this di luar class maka akan terjadi Fatal Error. Lalu bagaimanakah penggunaan variable $this yang benar?
  * Berikut ini adalah contohnya.
  *
  * class Rumah{
  *   function buka_rumah(){
  *     echo get_class($this);
  *   }
  * }
  * $rumah = new Rumah;
  * $rumah->buka_rumah();
  * Output:
  * Rumah
  *
  * $this disini berisi instance dari class itu sendiri dan hanya dapat diakses di dalam class itu sendiri.
  * Dengan menggunakan $this, tentunya kita juga dapat mengakses method dan property pada class tersebut.
  * Karena $this adalah object dirinya sendiri.
  * Contoh:
  *
  * class warung {
  *   public $jam_buka = "07:00";
  *
  *   function buka_warung() {
  *     echo $this->jam_buka;
  *   }
  * }
  *
  * $a = new warung;
  * $a->buka_warung();
  *
  * Output:
  * 07.00
  *
  * Disini tampak property $jam_buka diakses di dalam method buka_restoran() melalui variable $this.
  *
  * class restoran {
  *   public $jam_buka = "07:00";
  *   function buka_restoran() {
  *     echo $this->jam_buka;
  *   }
  * }
  * $a = new restoran;
  * $a->buka_restoran();
  *
  * Pada kode diatas $this itu bernilai seperti $a. jadi keduanya sama-sama object dari class yang sama.
  * Hanya saja $this dipergunakan secara khusus untuk mengakses instance tersebut dari dalam method yang
  * di-deklarasikan pada class tersebut.
  **/

/**
 * Inheritance
 *
 * Inheritance adalah pewarisan sebuah class.
 * Sebuah class dapat memiliki parent class atau induk class,
 * dan juga sebuah class juga dapat memiliki child class atau anak class.
 * Untuk melakukan pewarisan dapat kita gunakan keyword extends.
 * Contoh:
 *
 * Class A {
 *
 * }
 *
 * Class B extends A {
 *
 * }
 *
 * Disini class A adalah induk dari class B, dan class B adalah anak dari class A. Lalu apa yang membedakan inheritance?
 * Dalam inheritance, class anak (child class) dapat mengakses property dan method yang ada pada induknya (parent class).
 * Class anak juga dapat dikatakan sebagai instanceof parent classnya.
 * Berikut ini adalah contoh mengakses method parent class dari child class.
 *
 * Class A {
 *  public function index(){
 *    echo "index A";
 *  }
 * }

 * Class B extends A {
 *
 * }

 * $index = new B;
 * $index->index();
 *
 * Output:
 * index A
 *
 * Ok, disini tampak jelas sekali bahwa class B tidak memiliki method index(). Akan tetapi object yang dibentuk dari class B
 * dapat mengakses method index(), karena class B adalah keturunan dari class A dan dalam class A terdeklarasi method index.
 * Jadi intinya, anak class (child class) mewarisi property dan method pada induk class (parent class).
 *
 * Class A {
 *    public $nilai = 100;
 * }
 *
 * Class B extends A {
 *
 * }
 *
 * $test = new B;
 * echo $test->nilai;
 *
 * Output:
 * 100
 *
 * Dari output ini terbukti bahwa property nilai pada class A diwariskan kepada class B.
 **/
