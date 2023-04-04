<?php

namespace App\Repositories\CompaniesRepositories;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompaniesRepository implements CompaniesRepositoryInterface
{
    const TABLE = 'companies';
    const TABLE_RELATION_COMPANY_USER = 'company_user';

    public function createAndAssign(int $userId, array $data): int
    {
        try {
            DB::beginTransaction();
            $companyId = DB::table(self::TABLE)
                ->insertGetId($data);
            DB::table(self::TABLE_RELATION_COMPANY_USER)
                ->insert(['company_id' => $companyId, 'user_id' => $userId]);
            DB::commit();

            return $companyId;
        } catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }

    }

    public function getByUserId(int $userId): ?object
    {
        return DB::table('companies')
            ->join(self::TABLE_RELATION_COMPANY_USER, 'id', '=','company_id')
            ->where(self::TABLE_RELATION_COMPANY_USER.'.user_id', '=', $userId)
            ->get();
    }

    public function assignToUser($companyId, $userId)
    {
    }

}
