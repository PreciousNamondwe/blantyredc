<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationDocumentModel extends Model
{
    protected $table = 'application_documents';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'application_id',
        'document_type',
        'file_name',
        'file_path',
        'file_size',
        'mime_type'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $createdField = 'uploaded_at';

    // Validation
    protected $validationRules = [
        'application_id' => 'required|integer',
        'document_type' => 'required|max_length[100]',
        'file_name' => 'required|max_length[255]',
        'file_path' => 'required|max_length[500]',
        'file_size' => 'required|integer',
        'mime_type' => 'required|max_length[100]'
    ];

    /**
     * Get documents for an application
     */
    public function getApplicationDocuments($applicationId)
    {
        return $this->where('application_id', $applicationId)
                    ->orderBy('uploaded_at', 'DESC')
                    ->findAll();
    }

    /**
     * Delete document and file
     */
    public function deleteDocument($id)
    {
        $document = $this->find($id);
        if ($document && file_exists($document['file_path'])) {
            unlink($document['file_path']);
        }
        return $this->delete($id);
    }
}
