<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 30 Oct 2019 01:58:34 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Trade
 * 
 * @property int $id
 * @property float $amount
 * @property int $create_time
 * @property string $driver_mobile
 * @property int $driver_order_id
 * @property string $pay_method
 * @property int $status
 * @property string $trade_id
 * @property int $update_time
 *
 * @package App\Models
 */
class Trade extends Eloquent
{
	protected $table = 'Trade';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'amount' => 'float',
		'create_time' => 'int',
		'driver_order_id' => 'int',
		'status' => 'int',
		'update_time' => 'int'
	];

	protected $fillable = [
		'amount',
		'create_time',
		'driver_mobile',
		'driver_order_id',
		'pay_method',
		'status',
		'trade_id',
		'update_time'
	];
}
