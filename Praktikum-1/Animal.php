<?php

# membuat class Animal
class Animal
{
  # property animals
  public $data;

  # method constructor - mengisi data awal
  # parameter: data hewan (array)
  public function __construct($data)
  {
    $this->data = $data;
  }

  # method index - menampilkan data animals
  public function index()
  {
    # gunakan foreach untuk menampilkan data animals (array)
    print_r($this->data);
  }

  # method store - menambahkan hewan baru
  # parameter: hewan baru
  public function store($data)
  {
    # gunakan method array_push untuk menambahkan data baru
    array_push($this->data, $data);
  }

  # method update - mengupdate hewan
  # parameter: index dan hewan baru
  public function update($index, $data)
  {
    array_splice($this->data, $index, 1, $data);
  }

  # method delete - menghapus hewan
  # parameter: index
  public function destroy($index)
  {
    # gunakan method unset atau array_splice untuk menghapus data array
    array_splice($this->data, $index, 1);
  }
}

# membuat object
# kirimkan data hewan (array) ke constructor
$animal = new Animal(["Kucing", "Ayam", "Hiu", "Orang Utan"]);

echo "Index - Menampilkan seluruh hewan <br>";
$animal->index();
echo "<br>";

echo "Store - Menambahkan hewan baru <br>";
$animal->store('burung');
$animal->index();
echo "<br>";

echo "Update - Mengupdate hewan <br>";
$animal->update(0, 'Kucing Anggora');
$animal->index();
echo "<br>";

echo "Destroy - Menghapus hewan <br>";
$animal->destroy(1);
$animal->index();
echo "<br>";