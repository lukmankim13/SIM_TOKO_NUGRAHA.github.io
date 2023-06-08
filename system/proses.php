<?php
class Proses
{
    private $con;

    public function __construct()
    {
        // koneksi ke database
        $server = 'localhost';
        $user = 'root';
        $psw = '';
        $dbname = 'db_penjualan';
        try {
            $this->con = new PDO("mysql:host=$server;dbname=$dbname", $user, $psw);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Koneksi database gagal: " . $e->getMessage();
            die();
        }
    }

    // fungsi untuk mendapatkan data
    public function get($cel = null, $table = null, $property = null)
    {
        $qw = "SELECT $cel FROM $table $property";
        $ret = $this->con->query($qw);
        return $ret;
    }

    // fungsi untuk mengambil data
    public function ambil($cel = null, $table = null)
    {
        $qw = "SELECT $cel FROM $table";
        $ret = $this->con->query($qw);
        return $ret;
    }

    // fungsi untuk menambahkan data
    public function insert($table = null, $value = null)
    {
        $qw = "INSERT INTO $table VALUES($value)";
        $ret = $this->con->exec($qw);
        return $ret;
    }

    // fungsi untuk menghapus data
    public function delete($table = null, $condition = null)
    {
        $qw = "DELETE FROM $table WHERE $condition";
        $ret = $this->con->exec($qw);
        return $ret;
    }

    // fungsi untuk memperbarui data
    public function update($table = null, $value = null, $property = null)
    {
        $qw = "UPDATE $table SET $value WHERE $property";
        $ret = $this->con->exec($qw);
        return $ret;
    }
}

$db = new Proses;
?>