<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationDataModel extends Model
{
    protected $table = 'application_data';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'application_id',
        'data_type',
        'data_key',
        'data_value'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'application_id' => 'required|integer',
        'data_type' => 'required|max_length[50]',
        'data_key' => 'required|max_length[100]'
    ];

    /**
     * Save application data
     */
    public function saveData($applicationId, $dataType, $data)
    {
        if (!is_array($data) || empty($data)) {
            return false;
        }

        $insertData = [];
        foreach ($data as $key => $value) {
            $insertData[] = [
                'application_id' => $applicationId,
                'data_type' => $dataType,
                'data_key' => $key,
                'data_value' => is_array($value) ? json_encode($value) : $value
            ];
        }

        return $this->insertBatch($insertData);
    }

    /**
     * Get all data for an application
     */
    public function getApplicationData($applicationId)
    {
        $data = $this->where('application_id', $applicationId)->findAll();
        $formatted = [];

        foreach ($data as $item) {
            $value = $item['data_value'];

            // Try to decode JSON
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }

            if (!isset($formatted[$item['data_type']])) {
                $formatted[$item['data_type']] = [];
            }

            $formatted[$item['data_type']][$item['data_key']] = $value;
        }

        return $formatted;
    }

    /**
     * Synchronize/Update a clustered data type list array for an application.
     * Overwrites existing key records or creates them if missing.
     * * @param int $applicationId
     * @param string $dataType (e.g., 'applicant_details')
     * @param array $dataPairs [data_key => data_value]
     * @return bool
     */
    public function updateGroupData($applicationId, $dataType, array $dataPairs)
    {
        if (empty($dataPairs)) {
            return false;
        }

        foreach ($dataPairs as $key => $value) {
            $this->updateDataField($applicationId, $dataType, $key, $value);
        }

        return true;
    }

    /**
     * Get specific data type for application
     */
    public function getDataByType($applicationId, $dataType)
    {
        $data = $this->where('application_id', $applicationId)
                    ->where('data_type', $dataType)
                    ->findAll();

        $formatted = [];
        foreach ($data as $item) {
            $value = $item['data_value'];

            // Try to decode JSON
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }

            $formatted[$item['data_key']] = $value;
        }

        return $formatted;
    }

    /**
     * Update specific data field
     */
    public function updateDataField($applicationId, $dataType, $dataKey, $dataValue)
    {
        $value = is_array($dataValue) ? json_encode($dataValue) : $dataValue;

        // Check if exists
        $existing = $this->where('application_id', $applicationId)
                        ->where('data_type', $dataType)
                        ->where('data_key', $dataKey)
                        ->first();

        if ($existing) {
            return $this->update($existing['id'], ['data_value' => $value]);
        } else {
            return $this->insert([
                'application_id' => $applicationId,
                'data_type' => $dataType,
                'data_key' => $dataKey,
                'data_value' => $value
            ]);
        }
    }

    /**
     * Delete data by type
     */
    public function deleteDataByType($applicationId, $dataType)
    {
        return $this->where('application_id', $applicationId)
                    ->where('data_type', $dataType)
                    ->delete();
    }
}