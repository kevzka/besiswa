<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbRole
 * 
 * @property int $id_role
 * @property string $role
 * 
 * @property Collection|User[] $admins
 * @property Collection|TbEvidences[] $tb_evidences
 *
 * @package App\Models
 */
class TbRoles extends Model
{
	protected $table = 'tb_roles';
	protected $primaryKey = 'id_role';
	public $timestamps = false;

	protected $fillable = [
		'role'
	];

	public function admins()
	{
		return $this->hasMany(User::class, 'id_role');
	}

	public function tb_evidences()
	{
		return $this->hasMany(TbEvidences::class, 'type');
	}
}
