<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 30 Oct 2019 01:58:10 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class BossOrder
 * 
 * @property int $id
 * @property int $boss_id
 * @property string $cancel_reason
 * @property int $cancel_time
 * @property int $car_count
 * @property int $create_time
 * @property float $distance
 * @property string $from_adcode
 * @property string $from_mark
 * @property string $from_name
 * @property string $from_person_mobile
 * @property string $from_person_name
 * @property string $from_point
 * @property string $goods_id
 * @property float $load_fee
 * @property int $order_time
 * @property float $other_fee
 * @property float $price_factor
 * @property int $status
 * @property string $to_adcode
 * @property string $to_mark
 * @property string $to_name
 * @property string $to_person_mobile
 * @property string $to_person_name
 * @property string $to_point
 * @property float $price_total
 * @property float $unload_fee
 *
 * @package App\Models
 */
class BossOrder extends Eloquent
{
	protected $table = 'BossOrder';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'boss_id' => 'int',
		'cancel_time' => 'int',
		'car_count' => 'int',
		'create_time' => 'int',
		'distance' => 'float',
		'load_fee' => 'float',
		'order_time' => 'int',
		'other_fee' => 'float',
		'price_factor' => 'float',
		'status' => 'int',
		'price_total' => 'float',
		'unload_fee' => 'float'
	];

	protected $fillable = [
		'boss_id',
		'cancel_reason',
		'cancel_time',
		'car_count',
		'create_time',
		'distance',
		'from_adcode',
		'from_mark',
		'from_name',
		'from_person_mobile',
		'from_person_name',
		'from_point',
		'goods_id',
		'load_fee',
		'order_time',
		'other_fee',
		'price_factor',
		'status',
		'to_adcode',
		'to_mark',
		'to_name',
		'to_person_mobile',
		'to_person_name',
		'to_point',
		'price_total',
		'unload_fee'
	];
}
