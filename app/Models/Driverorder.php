<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Oct 2019 03:25:25 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Driverorder
 * 
 * @property int $id
 * @property float $amount
 * @property int $boss_order_id
 * @property string $cancel_reason
 * @property int $create_time
 * @property int $driver_id
 * @property float $margin_amount
 * @property int $pay_time
 * @property int $status
 * @property float $ton
 * @property string $ton_pic
 *
 * @package App\Models
 */
class Driverorder extends Eloquent
{
	protected $table = 'driverorder';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'amount' => 'float',
		'boss_order_id' => 'int',
		'create_time' => 'int',
		'driver_id' => 'int',
		'margin_amount' => 'float',
		'pay_time' => 'int',
		'status' => 'int',
		'ton' => 'float'
	];

	protected $fillable = [
		'amount',
		'boss_order_id',
		'cancel_reason',
		'create_time',
		'driver_id',
		'margin_amount',
		'pay_time',
		'status',
		'ton',
		'ton_pic'
	];
}
