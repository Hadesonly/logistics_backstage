<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 30 Oct 2019 01:57:52 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Boss
 * 
 * @property int $id
 * @property string $auth_fail_reason
 * @property int $auth_status
 * @property string $comment
 * @property int $create_time
 * @property int $gender
 * @property string $icon
 * @property string $id_card_back
 * @property string $id_card_front
 * @property string $id_card_num
 * @property string $mobile
 * @property string $name
 * @property string $nick
 * @property string $push_id
 * @property string $business_license
 *
 * @package App\Models
 */
class Boss extends Eloquent
{
	protected $table = 'Boss';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'auth_status' => 'int',
		'create_time' => 'int',
		'gender' => 'int'
	];

	protected $fillable = [
		'auth_fail_reason',
		'auth_status',
		'comment',
		'create_time',
		'gender',
		'icon',
		'id_card_back',
		'id_card_front',
		'id_card_num',
		'mobile',
		'name',
		'nick',
		'push_id',
		'business_license'
	];
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            if($model->comment == null){
                $model->comment = "无";
            }
            if($model->auth_status == null){
                $model->auth_status = 2;
            }

            $client = curl_init("https://duduhuoyun.cn/api/profile/updateAuthStatus");

            $body = array(
                "type" => "b",
                "set_identify_uid" => $model->id,
                "set_auth_status" => $model->auth_status,
                "identify_fail_reason" => $model->comment,
                "set_identity_status_token" => "2R4UENkbreoQWgaNjfGKseGR89i3wirqG3kKXnP4B7vvpwUqCCpn4AiZfeEB9UDd"
            );

            curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($client, CURLOPT_HEADER, false);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($client, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($body));
            $resp = curl_exec($client);
            curl_close($client);

        });
    }
}
