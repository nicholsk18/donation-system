<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Donations extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'donations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'user_id',
        'org_id',
        'amount',
        'note',
    ];

    protected $attributes = [
        'user_id' => 0,
        'org_id' => 0,
        'super_admin' => 0,
        'admin' => 0
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (isset($attributes['user'])) {
            $this->attributes['user_id'] = $attributes['user']->id;
            $this->attributes['org_id'] = $attributes['user']->org_id;
            $this->attributes['super_admin'] = $attributes['user']->super_admin;
            $this->attributes['admin'] = $attributes['user']->admin;
        }

    }

    public function getOrgDonations(): object {
        $user_id = $this->attributes['user_id'];
        $org_id = $this->attributes['org_id'];
        $is_admin = $this->attributes['admin'];

        $donations_query = DB::table($this->table);

        // if admin get all org donations
        if ($is_admin) {
            $donations_query->where($this->table . '.org_id', $org_id);
        } else {
            $donations_query->where($this->table . '.org_id', $org_id)
                ->where($this->table . '.user_id', $user_id);
        }

        $donations_query->leftJoin('users', 'users.id', '=', 'user_id')
            ->select("$this->table.*", 'users.first_name', 'users.last_name')
            ->orderBy('last_name');

        return $donations_query->get();
    }
}
