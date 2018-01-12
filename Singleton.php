<?php

Class A {
  private static $instance;

  public static function getInstance() {

    // kode1
    if (self::$instance === null) {
      self::$instance = new self;
    }
    // end kode1

    return self::$instance;
  }

  public $nilai = 10;

  public function ubahNilai() {
    $this->nilai = 100;
  }
}

$test = A::getInstance();

$test2 = A::getInstance();
$test3 = A::getInstance();

$test->ubahNilai();

print $test->nilai.PHP_EOL;
print $test2->nilai.PHP_EOL;
print $test3->nilai.PHP_EOL;
print PHP_EOL;

/**
 * Tampak ada sebuah private property bernama $instance bersifat static.
 * Dapat diperhatikan method getInstance, dia bersifat public dan static.
 * Inti dari method getInstance adalah membuat object dirinya sendiri. Disitu dapat dilakukan instansiasi pada keyword self.
 * Karena keyword self sendiri juga termasuk sebuah access static, sehingga dia melekat pada classnya sendiri.
 *
 * Pada kode diatas, 'new self' yang berada di dalam class A itu isinya tidaklah berberda dengan 'new A'
 *
 * Maksud dari 'kode1' adalah jika self::$instance bernilai null, maka self::$instance akan diisi dengan instance dirinya sendiri.
 *
 * Isi dari variable $test adalah hasil return dari methode getInstance(). Secara otomatis, $test berisi instance class A.
 * dan instance class A tersimpan secara static, sehingga dia menjadi object yang melekat pada class.
 * jadi kelebihan singleton adalah sebuah object dapat melekat secara static dan tentunya dia long lived, karena tidak perlu
 * passing reference lagi. cukup pakai T_PAAMAYIM_NEKUDOTAYIM.
 * Ketika dipanggil dimanapun semua isinya akan sama.
 *
 * Perhatikan kode '$test->ubahNilai()', disini saya merubah nilai dengan melakukannya pada variable $test. akan tetapi,
 * ketika program dijalankan. variable $test2 dan $test3 yang juga sama-sama mengakses 'nilai', kedua variable tersebut juga ikut
 * berubah nilainya.
 *
 * Ini terbukti bahwa instance pada singleton itu abadi sampai akhir program. Semua instance nya akan selalu melekat pada class.
 * Bahkan tanpa ditampung dengan variable di luar classnya sendiri dia bisa hidup hanya dengan methode getInstance.
 * Itulah keunikan singleton.
 *
 * Singleton pattern ini kerap digunakan dalam koneksi database yang instancenya dibagai diberbagai tempat.
 * Ataupun seperti parsing file dot env. Biasanya setelah diparsing, semua key dan value pada dot env disimpan pada singleton
 * Sehingga tidak perlu parsing lagi ketika ingin mendapat suatu nilai dari dot env.
 **/
