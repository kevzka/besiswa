<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbEvidence
 * 
 * @property int $id_evidence
 * @property int $id_admin
 * @property int $type
 * @property string $title
 * @property string $file
 * @property string $description
 * @property Carbon $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property User $admin
 * @property TbRoles $tb_role
 * @property Collection|TbLombas[] $tb_lombas
 *
 * @package App\Models
 */
class TbEvidences extends Model
{
	protected $table = 'tb_evidences';
	protected $primaryKey = 'id_evidence';

	protected $casts = [
		'id_admin' => 'int',
		'type' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'id_admin',
		'type',
		'title',
		'file',
		'description',
		'date'
	];

	public function admin()
	{
		return $this->belongsTo(User::class, 'id_admin');
	}

	public function tb_role()
	{
		return $this->belongsTo(TbRoles::class, 'type');
	}

	public function tb_lombas()
	{
		return $this->hasMany(TbLombas::class, 'id_evidence');
	}
}
