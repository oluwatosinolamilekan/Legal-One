<?php declare(strict_types=1);

namespace App\Actions;

use Doctrine\ORM\EntityManagerInterface;
use Exception;

class FilterLog
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct
    (
        public EntityManagerInterface $em,
    ){}

    /**
     * @param array $request
     * @throws Exception
     */
    public function run(array $request)
    {
        if($this->array_keys_exist($request,'serviceNames','startDate','endDate','statusCode')){
            return $this->em->createQueryBuilder()
                ->from('App\Entity\Log', 'a')
                ->where('a.name IN (:serviceNames)')
                ->andWhere('a.timestamp > :startDate')
                ->andWhere('a.timestamp > :endDate')
                ->andWhere('a.status = :status')
                ->setParameter('service', explode(',', $request['serviceNames']))
                ->setParameter('startDate', strtotime($request['startDate']))
                ->setParameter('endDate', strtotime($request['endDate']))
                ->setParameter('statusCode', $request['statusCode'])
                ->getQuery()
                ->execute();
        }else{
            $attributes = array_diff($request, ['serviceNames','startDate','endDate','statusCode']);
            throw new Exception("You missing keys");
        }

    }

    /**
     * Checks if multiple keys exist in an array
     *
     * @param array $array
     * @param array|string $keys
     *
     * @return bool
     */
    private function array_keys_exist(array $array, $keys ): bool
    {
        $count = 0;
        if ( ! is_array( $keys ) ) {
            $keys = func_get_args();
            array_shift( $keys );
        }
        foreach ( $keys as $key ) {
            if ( isset( $array[$key] ) || array_key_exists( $key, $array ) ) {
                $count ++;
            }
        }

        return count( $keys ) === $count;
    }

}
