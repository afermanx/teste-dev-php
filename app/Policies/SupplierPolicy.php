<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Supplier;
use App\Traits\ApiException;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
{
    use ApiException, HandlesAuthorization;

    public function supplierOwner(User $user, Supplier $supplier)
    {
        if ($user->id !== $supplier->user_id) {
            return $this->notFoundRequestException('Fornecedor não encontrado');
        }

        return true;
    }
}
