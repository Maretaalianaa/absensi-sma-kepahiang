<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
   protected $allowedFields = [
      'nip',
      'nama_guru',
      'jenis_kelamin',
      'alamat',
      'no_hp',
      'unique_code'
   ];

   protected $table = 'tb_guru';

   protected $primaryKey = 'id_guru';

   public function cekGuru(string $unique_code)
   {
      return $this->where(['unique_code' => $unique_code])->first();
   }

   public function getAllGuru()
   {
      return $this->orderBy('nama_guru')->findAll();
   }

   public function getGuruById($id)
   {
      return $this->where([$this->primaryKey => $id])->first();
   }

   public function saveGuru($idGuru, $nip, $namaGuru, $jenisKelamin, $alamat, $noHp)
   {
      return $this->save([
         $this->primaryKey => $idGuru,
         'nip' => $nip,
         'nama_guru' => $namaGuru,
         'jenis_kelamin' => $jenisKelamin,
         'alamat' => $alamat,
         'no_hp' => $noHp,
         'unique_code' => sha1($namaGuru . md5($nip . $namaGuru . $noHp)) . substr(sha1($nip . rand(0, 100)), 0, 24)
      ]);
   }
}
