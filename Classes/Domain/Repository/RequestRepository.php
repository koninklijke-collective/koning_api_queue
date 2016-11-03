<?php
namespace Keizer\KoningApiQueue\Domain\Repository;

/**
 * Request repository
 *
 * @package Keizer\KoningApiQueue\Domain\Repository
 */
class RequestRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param object $object
     * @return void
     */
    public function addAndPersist($object)
    {
        parent::add($object);
        $this->persistenceManager->persistAll();
    }

    /**
     * @param \DateTime|string $lastProcessDate
     * @param int $limit
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByLastProcessDateAndLimit($lastProcessDate, $limit)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $constraints = [];
        $constraints[] = $query->equals('lastProcessDate', $lastProcessDate);
        return $query
            ->matching($query->logicalAnd($constraints))
            ->setLimit((int) $limit)
            ->execute();
    }

    /**
     * @param \DateTime $since
     * @param int $limit
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findRetentionData(\DateTime $since, $limit)
    {
        $query = $this->createQuery();
        $constraints = [];
        $constraints[] = $query->lessThan('lastProcessDate',$since);
        return $query
            ->matching($query->logicalAnd($constraints))
            ->setLimit((int) $limit)
            ->execute();
    }
}
