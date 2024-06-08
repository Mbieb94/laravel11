<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $rules = [
        'fullname' => ['required', 'string', 'max:255'],
        'username' => ['required', 'unique'],
        'email' => ['required', 'unique']
    ];

    protected $createRules = [
        'password' => ['required', 'confirmed'],
    ];

    protected $fillable = [
        'photo',
        'fullname',
        'email',
        'username',
        'gender',
        'phone_number',
        'address',
        'password',
        'status',
    ];

    protected $forms = [
        [
            'name' => 'photo',
            'required' => false,
            'column' => 3,
            'label' => 'Photo',
            'type' => 'thumbnail',
            'display' => true
        ],
        [
            'name' => 'fullname',
            'required' => true,
            'column' => 5,
            'label' => 'Full Name',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'username',
            'required' => true,
            'column' => 5,
            'label' => 'Username',
            'type' => 'text',
            'display' => false
        ],
        [
            'name' => 'email',
            'required' => true,
            'column' => 5,
            'label' => 'Email',
            'type' => 'email',
            'display' => true
        ],
        [
            'name' => 'gender',
            'required' => true,
            'column' => 3,
            'label' => 'Gender',
            'type' => 'sysparam',
            'group' => 'Gender',
            'display' => true
        ],
        [
            'name' => 'address',
            'required' => false,
            'column' => 5,
            'label' => 'Address',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'phone_number',
            'required' => true,
            'column' => 4,
            'label' => 'Phone Number',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'password',
            'required' => true,
            'column' => 6, // max 9
            'label' => 'Password',
            'type' => 'password',
            'display' => false
        ],
        [
            'name' => 'status',
            'required' => true,
            'column' => 2,
            'label' => 'Status',
            'type' => 'sysparam',
            'group' => 'Activation',
            'hidden' => true,
            'display' => true
        ],
    ];

    protected $reference = [
        'status',
        'gender',
        // 'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRules()
    {
        return $this->rules;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getFields()
    {
        return $this->fillable;
    }

    public function getForms()
    {
        return $this->forms;
    }

    public function getTableName()
    {
        return $this->table;
    }

    public function checkTableExists($table_name)
    {
        return Schema::hasTable($table_name);
    }

    public function getTableFields()
    {
        return Schema::getColumnListing($this->getTable());
    }

    public function status ()
    {
        return $this->hasOne(Parameters::class, 'key', 'status')
            ->where('groups', 'Activation');
    }

    public function gender ()
    {
        return $this->hasOne(Parameters::class, 'key', 'gender')
            ->where('groups', 'Gender');
    }

    public function getFilesList()
    {
        return [];
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
