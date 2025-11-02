<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSiswa
 * 
 * @property int $id_siswa
 * @property string $nis
 * @property string $nama
 * @property string $kelas
 * @property string $jurusan
 * @property int $angkatan
 * @property float $poin_jiwa
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property Collection|TbSiswasLombas[] $tb_siswas_lombas
 *
 * @package App\Models
 */
class TbSiswas extends Model
{
	protected $table = 'tb_siswas';
	protected $primaryKey = 'id_siswa';

	protected $casts = [
		'angkatan' => 'int',
		'poin_jiwa' => 'float'
	];

	protected $fillable = [
		'nis',
		'nama',
		'kelas',
		'jurusan',
		'angkatan',
		'poin_jiwa'
	];

	public function tb_siswas_lombas()
	{
		return $this->hasMany(TbSiswasLombas::class, 'nis_siswa', 'nis');
	}
}
