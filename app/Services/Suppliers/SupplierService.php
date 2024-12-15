<?php

namespace App\Services\Suppliers;

use auth;
use App\Models\Supplier;
use App\Traits\ApiException;

class SupplierService
{
    use ApiException;
        /**
         * Create supplier
         * @param array $data
         * @return \App\Models\Supplier
         */
        public function create(array $data): Supplier
        {
            $data = $this->sanitizeData($data);
            if ($this->verifyUniqueDocument($data)) {
                $this->badRequestException(['error' => 'Documento já cadastrado.']);
            }
            if($this->verifyUniquePhone($data)) {
                $this->badRequestException(['error' => 'Telefone já cadastrado.']);
            }
            return Supplier::create($data);
        }

        /**
         * Verify unique document
         * @param array $data
         * @param mixed $supplier
         * @return bool
         */
        private function  verifyUniqueDocument(array &$data, ?Supplier $supplier = null): bool
        {
            $query = Supplier::query();
            if (! isset($data['document'])) {
                return false;
            }
            if (isset($data['document']['type'])) {
                $query->where('document->type', $data['document']['type']);
            }
            if (isset($data['document']['number'])) {
                $query->where('document->number', $data['document']['number']);
            }
            if ($supplier) {
                $query->where('id', '<>', $supplier->id);
            }
            return $query->exists();
        }

        /**
         * Verify unique phone
         * @param array $data
         * @param mixed $supplier
         * @return bool
         */
        private function verifyUniquePhone(array $data, ?Supplier $supplier = null): bool
        {

            $query = Supplier::query();

            if (isset($data['phone']['ddd'])) {
                $query->where('phone->ddd', $data['phone']['ddd']);
            }
            if (isset($data['phone']['number'])) {
                $query->where('phone->number', $data['phone']['number']);
            }
            if ($supplier) {
                $query->where('id', '<>', $supplier->id);
            }
            return $query->exists();
        }

        /**
         * Sanitize data
         * @param array $data
         * @return array
         */
        private function sanitizeData(array &$data): array
        {
        return [
            ...$data,
            'user_id' => auth()->user()->id,
            'fantasy_name' => $data['fantasy_name'] ?? $data['name'],
        ];
        }
}