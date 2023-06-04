<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Organization extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'organization';

    protected $admin_types = [ 'Super Admin', 'Admin' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'address',
        'address2',
        'city',
        'state',
        'zip',
        'country',
    ];

    /**
     * @param $org_id
     * @param bool $limit
     * @param $offset
     * @return object|\Illuminate\Support\Collection
     */
    public function get_org_users(int $org_id, int $offset = 0, int $limit = 10): object {
        $organization = DB::table($this->table)
            ->where($this->table . '.id', $org_id)
            ->leftJoin('users', 'users.org_id', '=', $this->table . '.id')
            ->select("$this->table.*", 'users.first_name', 'users.last_name')
            ->orderBy('last_name')
            ->offset($offset)->limit($limit);

        return $organization->get();
    }
}
