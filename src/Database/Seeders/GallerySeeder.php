<?php

namespace Molitor\Gallery\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\User\Exceptions\PermissionException;
use Molitor\User\Services\AclManagementService;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        try {
            /** @var AclManagementService $aclService */
            $aclService = app(AclManagementService::class);
            $aclService->createPermission('gallery', 'Galériák kezelése', 'admin');
        } catch (PermissionException $e) {
            $this->command->error($e->getMessage());
        }
    }
}
