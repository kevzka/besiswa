<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * 
 * @property int $id_admin
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $instagram
 * @property string $facebook
 * @property string $no_telp
 * @property int $id_role
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TbRole $tb_role
 * @property Collection|TbEvidence[] $tb_evidences
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admins';
	protected $primaryKey = 'id_admin';

	protected $casts = [
		'id_role' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'email',
		'instagram',
		'facebook',
		'no_telp',
		'id_role'
	];

	public function tb_role()
	{
		return $this->belongsTo(TbRoles::class, 'id_role');
	}

	public function tb_evidences()
	{
		return $this->hasMany(TbEvidences::class, 'id_admin');
	}
}
