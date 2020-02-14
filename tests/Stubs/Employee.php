<?php

declare(strict_types=1);

namespace Yiisoft\ActiveRecord\Tests\Stubs;

use Yiisoft\ActiveRecord\ActiveQuery;

/**
 * Class Employee
 *
 * @property int $id
 * @property int $department_id
 * @property string $first_name
 * @property string $last_name
 *
 * @property string $fullName
 * @property Department $department
 * @property Dossier $dossier
 */
class Employee extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'employee';
    }

    /**
     * Returns employee full name.
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Returns employee department.
     *
     * @return ActiveQuery
     */
    public function getDepartment(): ActiveQuery
    {
        return $this
            ->hasOne(Department::class, [
                'id' => 'department_id',
            ])
            ->inverseOf('employees')
        ;
    }

    /**
     * Returns employee department.
     *
     * @return ActiveQuery
     */
    public function getDossier(): ActiveQuery
    {
        return $this
            ->hasOne(Dossier::class, [
                'department_id' => 'department_id',
                'employee_id' => 'id',
            ])
            ->inverseOf('employee')
        ;
    }
}