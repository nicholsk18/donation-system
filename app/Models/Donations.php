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

    protected $admin_types = [ 'Super Admin', 'Admin' ];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }

    public function get_donations_by_user($user, $limit = false, $offset = false): object {
        $donations_query = DB::table($this->table);
        $donations_query->where($this->table . '.org_id', $user->org_id);
        $donations_query->orderByDesc('created_at');

        // If not admin, filter by user id
        if (!in_array($user->user_type, $this->admin_types)) {
            $donations_query->where($this->table . '.user_id', $user->id);
        }

        $donations_query->leftJoin('users', 'users.id', '=', 'user_id')
            ->select("$this->table.*", 'users.first_name', 'users.last_name')
            ->orderBy('last_name');

        // limit returns for latest
        // possible pagination later
        if ($limit && $offset) {
            $donations_query->offset(0)->limit(10);
        }

        return $donations_query->get();
    }

    public function donations_ytd($user): int {
        $donations_query = DB::table($this->table);
        $donations_query->where($this->table . '.org_id', $user->org_id);
        $donations_query->where('created_at', '>=', date('Y-m-d', strtotime('first day of january this year')));

        // If not admin, filter by user id
        if (!in_array($user->user_type, $this->admin_types)) {
            $donations_query->where($this->table . '.user_id', $user->id);
        }

        return (int) $donations_query->sum('amount');
    }
    public function donations_month($user): int {
        $donations_query = DB::table($this->table);
        $donations_query->where($this->table . '.org_id', $user->org_id);
        $donations_query->where('created_at', '>=', date('Y-m-01'));

        // If not admin, filter by user id
        if (!in_array($user->user_type, $this->admin_types)) {
            $donations_query->where($this->table . '.user_id', $user->id);
        }

        return (int) $donations_query->sum('amount');
    }
}
