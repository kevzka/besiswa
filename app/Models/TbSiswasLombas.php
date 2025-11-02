<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSiswasLomba
 * 
 * @property int $id_siswa_lomba
 * @property string $nis_siswa
 * @property int $id_lomba
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property TbLombas $tb_lomba
 * @property TbSiswas $tb_siswa
 *
 * @package App\Models
 */
class TbSiswasLombas extends Model
{
	protected $table = 'tb_siswas_lombas';
	protected $primaryKey = 'id_siswa_lomba';

	protected $casts = [
		'id_lomba' => 'int'
	];

	protected $fillable = [
		'nis_siswa',
		'id_lomba'
	];

	public function tb_lomba()
	{
		return $this->belongsTo(TbLombas::class, 'id_lomba');
	}

	public function tb_siswa()
	{
		return $this->belongsTo(TbSiswas::class, 'nis_siswa', 'nis');
	}
}
