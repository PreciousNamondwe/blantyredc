<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSessionModel extends Model
{
    protected $table = 'user_sessions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'session_token',
        'ip_address',
        'user_agent',
        'expires_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'user_id' => 'required|integer',
        'session_token' => 'required|max_length[255]',
        'ip_address' => 'required|max_length[45]',
        'expires_at' => 'required'
    ];

    /**
     * Create new session
     */
    public function createSession($userId, $ipAddress, $userAgent = null)
    {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+7 days'));

        $sessionId = $this->insert([
            'user_id' => $userId,
            'session_token' => $token,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'expires_at' => $expiresAt
        ]);

        return $sessionId ? $token : false;
    }

    /**
     * Validate session token
     */
    public function validateSession($token)
    {
        $session = $this->where('session_token', $token)
                       ->where('expires_at >', date('Y-m-d H:i:s'))
                       ->first();

        return $session;
    }

    /**
     * Get user sessions
     */
    public function getUserSessions($userId, $activeOnly = true)
    {
        $query = $this->where('user_id', $userId);

        if ($activeOnly) {
            $query->where('expires_at >', date('Y-m-d H:i:s'));
        }

        return $query->orderBy('created_at', 'DESC')->findAll();
    }

    /**
     * Expire session
     */
    public function expireSession($token)
    {
        return $this->where('session_token', $token)
                    ->set(['expires_at' => date('Y-m-d H:i:s')])
                    ->update();
    }

    /**
     * Clean expired sessions
     */
    public function cleanExpiredSessions()
    {
        return $this->where('expires_at <=', date('Y-m-d H:i:s'))->delete();
    }

    /**
     * Extend session
     */
    public function extendSession($token, $hours = 24)
    {
        $newExpiry = date('Y-m-d H:i:s', strtotime("+{$hours} hours"));

        return $this->where('session_token', $token)
                    ->set(['expires_at' => $newExpiry])
                    ->update();
    }
}