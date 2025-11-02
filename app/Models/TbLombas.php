<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbLomba
 * 
 * @property int $id_lomba
 * @property int $id_evidence
 * @property string $tingkat_lomba
 * @property string $tingkat_juara
 * @property float $poin_lomba
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property TbEvidences $tb_evidence
 * @property Collection|TbSiswasLombas[] $tb_siswas_lombas
 *
 * @package App\Models
 */
class TbLombas extends Model
{
	protected $table = 'tb_lombas';
	protected $primaryKey = 'id_lomba';

	protected $casts = [
		'id_evidence' => 'int',
		'poin_lomba' => 'float'
	];

	protected $fillable = [
		'id_evidence',
		'tingkat_lomba',
		'tingkat_juara',
		'poin_lomba'
	];

	public function tb_evidences()
	{
		return $this->belongsTo(TbEvidences::class, 'id_evidence');
	}

	public function tb_siswas_lombas()
	{
		return $this->hasMany(TbSiswasLombas::class, 'id_lomba');
	}
}
