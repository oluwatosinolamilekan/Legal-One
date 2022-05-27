<?php declare(strict_types=1);

namespace App\Actions;

use App\Entity\Log;
use Doctrine\DBAL\Exception as DBException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class CreateLog
{
    /**
     * @param EntityManagerInterface $em
     * @param ManagerRegistry $doctrine
     * @param $projectDir
     */
    public function __construct(
        public EntityManagerInterface $em,
        public ManagerRegistry $doctrine,
        public  $projectDir,
    ){}


    /**
     * @param $fileName
     * @return string
     */
    public function run($fileName)
    {
        try {
            return $this->action($fileName);
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * @throws DBException
     * @throws Exception
     */
    private function action($fileName)
    {
        $filename = $this->projectDir . '/public/' . $fileName;
        if(!$fileName) throw new Exception('File doesnt exist');
        $contents = explode("\n", file_get_contents($filename));

        foreach($contents as $content){
          [$service, $info] = explode(' - - ', $content);

            $res = str_replace(array( '[', ']' ), '', $info);
            $splitInfo = explode(' ', $res);

            $entityManager = $this->doctrine->getManager();
            //using db transaction to save records.
            $this->em->getConnection()->beginTransaction();

            $log = new Log();
            $log->setName($service);
            $log->setDate($splitInfo[0]." ". $splitInfo[1]);
            $log->setMethod($splitInfo[2]);
            $log->setEndpoint($splitInfo[3]);
            $log->setStatus($splitInfo[5]);

            $entityManager->persist($log);
            $entityManager->flush();

            $this->em->getConnection()->commit();
        }
        return true;
    }
}
